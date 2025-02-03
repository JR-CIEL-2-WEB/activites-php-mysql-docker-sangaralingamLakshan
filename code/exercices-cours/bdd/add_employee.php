<?php
header("Content-Type: application/json");

$host = "mysql";
$dbname = "appdb";
$user = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $data = json_decode(file_get_contents('php://input'), true);

    // Validation des données
    if (isset($data['name'], $data['address'], $data['salary'])) {
        // Insertion dans la table Employes (on n'insère pas directement employe_id)
        $stmt = $pdo->prepare("INSERT INTO Employes (name, address) VALUES (:name, :address)");
        $stmt->execute([
            ':name' => $data['name'],
            ':address' => $data['address']
        ]);
        $id = $pdo->lastInsertId();

        // Mise à jour de la colonne employe_id dans Employes pour qu'elle soit identique à id
        $stmt = $pdo->prepare("UPDATE Employes SET employe_id = :employe_id WHERE id = :id");
        $stmt->execute([
            ':employe_id' => $id,
            ':id' => $id
        ]);

        // Insertion du salaire dans la table Salaire en utilisant employe_id
        $stmt = $pdo->prepare("INSERT INTO Salaire (salaire, employe_id) VALUES (:salaire, :employe_id)");
        $stmt->execute([
            ':salaire' => $data['salary'],
            ':employe_id' => $id
        ]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Données manquantes']);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur : " . $e->getMessage()]);
}
?>
