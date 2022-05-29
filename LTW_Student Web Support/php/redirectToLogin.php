<?php
    session_start();

    if(!isset($_SESSION['id'])){
    
        header("Location: ../html/login.html");
    }
    else {
        $session = $_SESSION['id'];
        header("Location: ./amministrazione.php");
    }

?>