<?php
// Inclure le fichier contenant les fonctions de tri
include 'trie.php'; 

// Test de la fonction tri_selection_valeur
echo "Test avec tri_selection_valeur  :<br>";
$tab_valeur = [4, 2, 8, 1, 5];
echo "Tableau avant tri : ";
read_tab($tab_valeur);  // Affiche le tableau avant le tri
$sorted_tab_valeur = tri_selection_valeur($tab_valeur);
echo "Tableau après tri : ";
read_tab($sorted_tab_valeur);  // Affiche le tableau trié

echo "<br>";

// Test de la fonction
echo "Test avec tri_selection_reference  :<br>";
$tab_reference = [10, 3, 6, 7, 2];
echo "Tableau avant tri : ";
read_tab($tab_reference);  // Affiche le tableau avant le tri
tri_selection_reference($tab_reference);
echo "Tableau après tri : ";
read_tab($tab_reference);  // Affiche le tableau trié

?>
