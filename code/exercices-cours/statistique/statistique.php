<?php
    function moyenne(array $notes) {
        $nb_notes = 0;
        $total = 0;
        foreach($notes as $matiere => $note) {
            $nb_notes += 1;
            $total += $note;
        }
        echo "la moyenne est de ".$total/$nb_notes."/20\n";
    }
    function mediane(array $listes) {
        sort($listes);
        $nb_elements = count($listes);
        if ($nb_elements % 2 == 0) {
            $milieu = ($listes[$nb_elements / 2 - 1] + $listes[$nb_elements / 2]) / 2;
        } else {
            $milieu = $listes[floor($nb_elements / 2)];
        }
        echo "La médiane est " . $milieu . "\n";
    }
?>

