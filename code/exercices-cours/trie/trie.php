<?php
function tri_selection_valeur($t) {
    $n = count($t);
    for ($i = 0; $i < $n - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($t[$j] < $t[$min]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $temp = $t[$i];
            $t[$i] = $t[$min];
            $t[$min] = $temp;
        }
    }
    return $t;
}
function tri_selection_reference(&$t) {
    $n = count($t);
    for ($i = 0; $i < $n - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($t[$j] < $t[$min]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $temp = $t[$i];
            $t[$i] = $t[$min];
            $t[$min] = $temp;
        }
    }
}
function read_tab($tab) {
    foreach ($tab as $value) {
        echo $value . ' ';
    }
    echo "<br>";
}

?>