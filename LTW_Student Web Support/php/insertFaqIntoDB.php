<?php
    if(isset($_POST['domanda']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $domanda= $_POST['domanda'];
        $risposta= $_POST['risposta'];


        $insert = "INSERT INTO faq (domanda, risposta) VALUES ($1, $2)";

        $data = pg_query_params($dbconn, $insert, array($domanda, $risposta));

        if ($data) {
            echo "<div class='notifica-success'>Faq aggiunta con successo!</div>";
        }
        else {
            echo "<div class='news-error'>Qualcosa è andato storto nell'inserimento dei dati. Per favore, riprova più tardi!</div>";
        }
        
        pg_close($dbconn);
    }
?>