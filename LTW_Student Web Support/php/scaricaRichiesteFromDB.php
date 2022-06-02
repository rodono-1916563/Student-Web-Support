<?php
    if(isset($_POST['request']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $select = "SELECT * FROM supporto";
        $result = pg_query($dbconn, $select);

        
        echo    "<div id='richieste' class='container'>
                    <div class='container justify-content-center pb-4'>
                        <div class='col-12 text-center'>
                            <h6 class='display-4 bold'>Richieste in sospeso:</h6>
                        </div>
                    </div>
                </div>"
            ;

        while($row = pg_fetch_array($result))
        {
            $id = $row['id'];
            $nome = $row['nome'];
            $cognome = $row['cognome'];
            $email = $row['email'];
            $oggetto = $row['oggetto'];
            $descrizione = $row['descrizione'];


            echo    "<div class='question col px-5 mt-2'>
                        <button id='btn-$id' onclick='return mostraRisposta($id)'>
                            <span>$oggetto<br>Da: $email</span>
                            <i class='fas fa-angle-down d-arrow'></i>
                        </button>
            
                        <p>$descrizione<br><span class='bold'>$nome $cognome</span></p>
                    </div>"
                ;
        }

        pg_close($dbconn);

    }

?>