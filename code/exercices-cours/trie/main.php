<?php

include 'trie.php';

// Test avec tri_selection_valeur
echo "Test avec tri_selection_valeur :<br>";
$tab_valeur = [4, 2, 8, 1, 5];
echo "Tableau avant tri : ";
read_tab($tab_valeur);
$tab_valeurs = tri_selection_valeur($tab_valeur);
echo "Tableau après tri : ";
read_tab($tab_valeurs);

echo "<br>";

// Test avec tri_selection_reference
echo "Test avec tri_selection_reference :<br>";
$tab_reference = [10, 3, 6, 7, 2];
echo "Tableau avant tri : ";
read_tab($tab_reference);
tri_selection_reference($tab_reference);
echo "Tableau après tri : ";
read_tab($tab_reference);

?>
