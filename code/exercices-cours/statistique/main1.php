<?php
include 'budget.php';

$budget = 1000;
$achats = 500;

if (budget(achats: $achats, budget: $budget)) {
    echo "Le budget ($budget €) permet de payer tous les achats ($achats €).<br/>";
} else {
    echo "Le budget ($budget €) ne permet pas de payer tous les achats ($achats €).<br/>";
}
?>