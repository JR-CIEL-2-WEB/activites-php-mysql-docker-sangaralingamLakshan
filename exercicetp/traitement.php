<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitement Formulaire</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
        }
        .data {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        .data h3 {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Résultat du formulaire</h2>
        <div class="data">
            <?php
            // Vérification des données POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = htmlspecialchars($_POST['name'] ?? 'N/A');
                $prenom = htmlspecialchars($_POST['prénom'] ?? 'N/A');
                $email = htmlspecialchars($_POST['email'] ?? 'N/A');
                $password = htmlspecialchars($_POST['password'] ?? 'N/A');
                $message = htmlspecialchars($_POST['message'] ?? 'N/A');
                $major = isset($_POST['formCheck-1']) ? 'Oui' : 'Non';

                echo "<h3>Données reçues :</h3>";
                echo "<p><strong>Nom : </strong>$name</p>";
                echo "<p><strong>Prénom : </strong>$prenom</p>";
                echo "<p><strong>Email : </strong>$email</p>";
                echo "<p><strong>Mot de passe : </strong>$password</p>";
                echo "<p><strong>Message : </strong>$message</p>";
                echo "<p><strong>Âge confirmé : </strong>$major</p>";
            } else {
                echo "<p>Pas de données reçues.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>
