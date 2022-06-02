<?php  

    if(isset($_POST['email']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $email= $_POST['email'];

        // COntrolla se è vuota
        if (empty($email)) {
            echo "<div class='news-error'>L'email non può essere vuota!</div>";
        }
        else 
        {
            // Controlla se è valida, se non lo è:
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                echo "<div class='news-error'>Questa email non è valida!</div>";

            // Altrimenti è valida
            else{
                $select = "SELECT email FROM newsletter WHERE email=($1)";
                $result = pg_query_params($dbconn, $select, array($email));
              
                if (pg_num_rows($result) > 0) {
                    // L'email è registrata
                    echo "<div class='news-error'>Questa email è già registrata!</div>";
                }
                else{
        
                    // Se l'email non è stata registrata
                    $query = "INSERT INTO newsletter VALUES ($1)";
        
                    $data = pg_query_params($dbconn, $query, array($email));
        
                    if ($data) {
                        echo "<div class='notifica-success'>Grazie la tua registrazione!</div>";
                    }
                    else
                    {
                        echo "<div class='news-error'>Qualcosa è andato storto nell'inserimento dei dati. Per favore, riprova più tardi!</div>";
                    }
                }
            }
        }
        
        pg_close($dbconn);
    }

?>
