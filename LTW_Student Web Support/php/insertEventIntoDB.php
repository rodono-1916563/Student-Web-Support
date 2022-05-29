<?php

    if(isset($_POST['nome']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $nome= $_POST['nome'];
        $descrizione= $_POST['descrizione'];
        $luogo= $_POST['luogo'];
        $giorno= $_POST['giorno'];
        $ora= $_POST['ora'];
        $immagine= $_POST['immagine'];

        $temp = explode("\\", $immagine);   // Per ottenere solamente il nome dell'immagine
        $immagine = "./immagini/" . $temp[2];   // Per costruire il path dell'immagine che voglio salvare nel DB

        if(!file_exists("." . $immagine)) {

            echo "<div class='news-error'>Non è stata trovata alcuna immagine $immagine. Si consiglia di riprovare!</div>";
        }

        else{

            $insert = "INSERT INTO eventi (nome, descrizione, luogo, giorno, ora, foto) VALUES ($1,$2,$3,$4,$5,$6)";

            $data = pg_query_params($dbconn, $insert, array($nome, $descrizione, $luogo, $giorno, $ora, $immagine));

            if ($data) {
                echo "<div class='notifica-success'>Evento aggiunto con successo!</div>";
            }
            else {
                echo "<div class='news-error'>Qualcosa è andato storto nell'inserimento dei dati. Per favore, riprova più tardi!</div>";
            }
        }
        
        pg_close($dbconn);
    }

    

?>