<?php
    if(isset($_POST['request']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $id = $_POST['id_faq'];

        $delete = "DELETE FROM faq WHERE id = $id";
        $result = pg_query($dbconn, $delete);

        if ($result) {
            echo "<div class='notifica-success'>Faq eliminata con successo!</div>";
        }
        else {
            echo "<div class='news-error'>Qualcosa è andato storto nella cancellazione. Per favore, riprova più tardi!</div>";
        }

        pg_close($dbconn);

    }

?>