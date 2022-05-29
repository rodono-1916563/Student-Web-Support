<?php
    if(isset($_POST['request']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $select = "SELECT * FROM faq";
        $result = pg_query($dbconn, $select);

        while($row = pg_fetch_array($result))
        {
            $id = $row['id'];
            $domanda = $row['domanda'];
            $risposta = $row['risposta'];

            echo    "<div class='question col px-5 mt-2'>
                        <button id='btn-$id' onclick='return mostraRisposta($id)'>
                            <span>$domanda</span>
                            <i class='fas fa-angle-down d-arrow'></i>
                        </button>
            
                        <p>$risposta</p>
                    </div>"
                ;
        }

        pg_close($dbconn);

    }

?>