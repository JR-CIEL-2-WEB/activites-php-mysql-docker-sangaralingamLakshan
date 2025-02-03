<?php
header("Content-Type: application/json");

// Connexion à la base de données
$host = "mysql"; // ou 127.0.0.1
$dbname = "appdb"; // Nom de la base de données
$user = "root"; // Utilisateur
$password = "root"; // Mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Requête pour récupérer les employés et leurs salaires
    $stmt = $pdo->query("
        SELECT E.id, E.name, E.address, E.employe_id, S.salaire 
        FROM Employes AS E
        LEFT JOIN Salaire AS S ON E.employe_id = S.employe_id
        ORDER BY S.salaire ASC
    ");
    
    $employees = $stmt->fetchAll();

    // Calcul de la médiane des salaires
    $salaries = array_column($employees, "salaire");
    $count = count($salaries);
    
    if ($count > 0) {
        $median = ($count % 2 == 0) 
            ? ($salaries[$count / 2 - 1] + $salaries[$count / 2]) / 2 
            : $salaries[floor($count / 2)];
    } else {
        $median = "Aucun salaire disponible.";
    }

    // Réponse JSON
    echo json_encode([
        "employees" => $employees,
        "median" => $median
    ]);

} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion : " . $e->getMessage()]);
}
?>
