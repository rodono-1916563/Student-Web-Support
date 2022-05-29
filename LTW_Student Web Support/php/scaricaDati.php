<?php
    session_start();

    if(!isset($_SESSION['id'])){

        header("Location: ../html/login.html");
    }

    if(isset($_POST['n_faq']))
        {
            $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

            if(!$dbconn){
                die('Could not connect: ' . pg_last_error());
            }


            // Per ottenere il numero di faq presenti nel DB
            $select_n_faq = "SELECT count(*) AS nf FROM faq";
            $n_faq = pg_query($dbconn, $select_n_faq);

            // Per ottenere il numero di eventi presenti nel DB
            $select_n_eventi = "SELECT count(*) AS ne FROM eventi";
            $n_eventi = pg_query($dbconn, $select_n_eventi);

            // Per ottenere il numero di ticket che non hanno avuto risposta presenti nel DB
            $select_n_ticket = "SELECT count(*) AS nt FROM supporto WHERE risposta = false";
            $n_ticket = pg_query($dbconn, $select_n_ticket);

            // Per ottenere il numero di iscritti alla newsletter
            $select_n_news = "SELECT count(*) AS ns FROM newsletter";
            $n_news = pg_query($dbconn, $select_n_news);

            $row_nf = pg_fetch_array($n_faq);
            $row_ne = pg_fetch_array($n_eventi);
            $row_nt = pg_fetch_array($n_ticket);
            $row_ns = pg_fetch_array($n_news);

            // Creo un array associativo con i dati raccolti
            $dati_from_db = array('n_faq' => $row_nf['nf'], 'n_eventi' => $row_ne['ne'], 'n_ticket' => $row_nt['nt'], 'n_news' => $row_ns['ns']); 

            // Invio i dati come un json
            echo json_encode($dati_from_db);

            pg_close($dbconn);
        }
?>