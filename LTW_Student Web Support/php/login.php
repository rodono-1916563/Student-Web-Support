<?php
    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) 
    {

        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $select = "SELECT * FROM amministratori WHERE username = $1 AND password = $2";

        $result = pg_query_params($dbconn, $select, array($username, $password));


        // Se la query restituisce dei dati, vuol dire che Username e Password sono corretti
        if ($row = pg_fetch_array($result, null, PGSQL_ASSOC))
        {
            
            $_SESSION['id'] = $row["username"];

            // Facciamo sapere al client che l'utente è un amministratore
            echo "valido";
        }
        else{
            // Altrimenti, qualcuno sta tentando di accedere ma non è un amministratore!
            echo "<div class='news-error'>Quest'area è riservata solamente agli amministratori!</div>";
        }
    }

?>