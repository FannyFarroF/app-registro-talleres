<?php
    $conn = mysqli_connect(
        "localhost", 
        "root", 
        "", 
        "prueba");

    if (isset($conn)) {
        return true;
    }
?>