<?php
// Inclusion des fichiers nécessaires
require_once 'config.php';
require_once 'mediane.php';
require_once 'moyenne.php';
require_once 'tri_selection.php';

// Récupération des salaires dans la base de données
try {
    $query = $pdo->query("SELECT salaire FROM employees"); // Remplacez "employees" par le nom de votre table
    $salaries = $query->fetchAll(PDO::FETCH_COLUMN);

    echo "<h2>Liste des salaires</h2>";
    foreach ($salaries as $salaire) {
        echo $salaire . " ";
    }
    echo "<br><br>";

    // Calcul de la médiane
    echo "<h2>Médiane</h2>";
    mediane($salaries);

    // Calcul de la moyenne
    echo "<h2>Moyenne</h2>";
    $moyenne = moyenne($salaries);
    echo "La moyenne est : $moyenne <br>";

    // Tri des salaires (par valeur)
    echo "<h2>Tri par sélection (valeur)</h2>";
    $salaries_triés = tri_selection_valeur($salaries);
    read_tab($salaries_triés);

    // Tri des salaires (par référence)
    echo "<h2>Tri par sélection (référence)</h2>";
    tri_selection_reference($salaries);
    read_tab($salaries);

} catch (PDOException $e) {
    echo "Erreur lors de la récupération des salaires : " . $e->getMessage();
}
?>
