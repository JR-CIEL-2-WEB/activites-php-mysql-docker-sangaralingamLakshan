<?php
function triangle($lignes) {
    for ($i = 1; $i <= $lignes; $i++) {
        echo str_repeat('*', $i) . "<br>"; 
}

}
triangle(10);
?>