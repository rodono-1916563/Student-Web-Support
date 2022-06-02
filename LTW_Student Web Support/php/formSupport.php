<?php

    if(isset($_POST['invioForm']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $nome= $_POST['nome'];
        $cognome= $_POST['cognome'];
        $email= $_POST['email'];
        $oggetto= $_POST['oggetto'];
        $descrizione= $_POST['descrizione'];

        $q2 = "INSERT INTO supporto (nome, cognome, email, oggetto, descrizione) VALUES ($1,$2,$3,$4,$5)";

        $data = pg_query_params($dbconn, $q2,array($nome, $cognome, $email, $oggetto, $descrizione));

        if ($data) {
            header('Location: ../html/contactSuccess.html');
        }


        pg_close($dbconn);
    }
?>

