<?php

    session_start();

    unset($_SESSION['id']);

    session_destroy();

    // Torno alla tab di login
    header("Location: ../html/login.html");

?>