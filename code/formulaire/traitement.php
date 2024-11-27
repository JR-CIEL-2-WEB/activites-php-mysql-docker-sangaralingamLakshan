<?php
session_start();

// Fichier de données pour stocker les utilisateurs
$dataFile = 'data.json';
$users = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user'])) {
    // Utilisateur déjà connecté : afficher le profil
    $user = $_SESSION['user'];
    $avatar = $user['avatar'] ?? 'default-avatar.png'; // Avatar par défaut
    echo "
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Profil de {$user['prenom']}</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>
        <style>
            body { background: linear-gradient(135deg, #6c63ff, #ad7ffb); color: #ffffff; font-family: 'Arial', sans-serif; }
            .profile-container { background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15); width: 100%; max-width: 400px; text-align: center; }
            .profile-container img { border-radius: 50%; width: 120px; height: 120px; object-fit: cover; margin-bottom: 20px; }
            .profile-container h3 { margin-bottom: 20px; }
        </style>
    </head>
    <body>
        <div class='profile-container'>
            <img src='$avatar' alt='Avatar'>
            <h3>{$user['prenom']} {$user['name']}</h3>
            <p><strong>Email:</strong> {$user['email']}</p>
            <p><strong>Message:</strong> {$user['message']}</p>
            <p><strong>Majeur:</strong> " . ($user['of_age'] ? 'Oui' : 'Non') . "</p>
            <a href='?deconnexion' class='btn btn-danger'>Se déconnecter</a>
        </div>
    </body>
    </html>
    ";
    exit();
}

// Déconnexion
if (isset($_GET['deconnexion'])) {
    session_unset();
    session_destroy();
    header('Location: traitement.php');
    exit();
}

// Traitement de l'inscription ou de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises
    $name = htmlspecialchars($_POST['name'] ?? '');
    $prenom = htmlspecialchars($_POST['prénom'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    $of_age = isset($_POST['of_age']) ? true : false;

    // Gestion de l'upload de l'avatar
    $avatarPath = '';
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = 'uploads/';
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0777, true); // Crée le répertoire s'il n'existe pas
        }
        $tmpName = $_FILES['avatar']['tmp_name'];
        $fileName = uniqid() . '_' . basename($_FILES['avatar']['name']);
        $avatarPath = $uploadsDir . $fileName;

        if (!move_uploaded_file($tmpName, $avatarPath)) {
            die('Erreur lors du téléchargement de l\'avatar.');
        }
    }

    // Validation des champs
    if (!$name || !$prenom || !$email || !$password || !$message) {
        die('Tous les champs sont obligatoires.');
    }

    // Recherche d'un utilisateur existant
    $existingUser = null;
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $existingUser = $user;
            break;
        }
    }

    if ($existingUser) {
        // Si l'utilisateur existe déjà, vérifier le mot de passe
        if (password_verify($password, $existingUser['password'])) {
            // Connexion réussie
            $_SESSION['user'] = $existingUser;
            header('Location: traitement.php');
            exit();
        } else {
            die('Mot de passe incorrect.');
        }
    } else {
        // Nouvel utilisateur : ajouter et rediriger vers le profil
        $newUser = [
            'name' => $name,
            'prenom' => $prenom,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash du mot de passe
            'message' => $message,
            'of_age' => $of_age,
            'avatar' => $avatarPath
        ];
        $users[] = $newUser;
        file_put_contents($dataFile, json_encode($users, JSON_PRETTY_PRINT));

        $_SESSION['user'] = $newUser;
        header('Location: traitement.php');
        exit();
    }
}

// Affichage du formulaire d'inscription/connexion si l'utilisateur n'est pas connecté
echo "
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Inscription / Connexion</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>
    <style>
        body { background: linear-gradient(135deg, #6c63ff, #ad7ffb); color: #ffffff; font-family: 'Arial', sans-serif; }
        .form-container { background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1); max-width: 500px; margin: 100px auto; }
    </style>
</head>
<body>
    <div class='form-container'>
        <h2 class='text-center'>Inscription / Connexion</h2>
        <form method='POST' action='traitement.php' enctype='multipart/form-data'>
            <div class='mb-3'>
                <label for='name' class='form-label'>Nom</label>
                <input type='text' class='form-control' id='name' name='name' required>
            </div>
            <div class='mb-3'>
                <label for='prénom' class='form-label'>Prénom</label>
                <input type='text' class='form-control' id='prénom' name='prénom' required>
            </div>
            <div class='mb-3'>
                <label for='email' class='form-label'>Email</label>
                <input type='email' class='form-control' id='email' name='email' required>
            </div>
            <div class='mb-3'>
                <label for='password' class='form-label'>Mot de passe</label>
                <input type='password' class='form-control' id='password' name='password' required>
            </div>
            <div class='mb-3'>
                <label for='message' class='form-label'>Message</label>
                <textarea class='form-control' id='message' name='message' required></textarea>
            </div>
            <div class='form-check'>
                <input class='form-check-input' type='checkbox' id='formCheck-1' name='of_age'>
                <label class='form-check-label' for='formCheck-1'>Je suis majeur</label>
            </div>
            <div class='mb-3'>
                <label for='avatar' class='form-label'>Avatar (optionnel)</label>
                <input type='file' class='form-control' id='avatar' name='avatar' accept='image/*'>
            </div>
            <button type='submit' class='btn btn-primary w-100'>Envoyer</button>
        </form>
    </div>
</body>
</html>
";
?>
