<?php
// Configuration de la base de données
$host = 'localhost';  // Remplacez par votre hôte
$dbname = 'nom_de_la_base';  // Remplacez par le nom de votre base de données
$username = 'eleve';  // Nom d'utilisateur fourni dans l'image
$password = 'eleve';  // Mot de passe fourni dans l'image

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
