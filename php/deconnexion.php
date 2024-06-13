<?php
    session_start();
    unset($_SESSION['pseudo']);
    unset($_SESSION['progression']);
    header("Location:index.php");
?>