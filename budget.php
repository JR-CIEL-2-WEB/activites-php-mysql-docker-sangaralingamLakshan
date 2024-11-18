<?php
function budget(float $budget, float $achats): bool {
    return $budget >= $achats;
}
?>