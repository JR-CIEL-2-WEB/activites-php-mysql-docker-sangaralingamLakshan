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
    if (isset($data['id'])) {
        $employeId = $data['id'];

        // Suppression dans la table Salaire
        $stmt = $pdo->prepare("DELETE FROM Salaire WHERE employe_id = :employe_id");
        $stmt->execute([':employe_id' => $employeId]);

        // Suppression dans la table Employes
        $stmt = $pdo->prepare("DELETE FROM Employes WHERE id = :id");
        $stmt->execute([':id' => $employeId]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'ID manquant']);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur : " . $e->getMessage()]);
}
?>
