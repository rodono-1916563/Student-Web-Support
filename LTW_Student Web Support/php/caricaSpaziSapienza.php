<?php

    if(isset($_POST['request']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $select = "SELECT * FROM spazi";
        $result = pg_query($dbconn, $select);

        while($row = pg_fetch_array($result))
        {
            $id = $row['id'];
            $nome = $row['nome'];
            $descrizione = $row['descrizione'];
            $foto = $row['foto'];

            echo    "<div class='swiper-slide'>
                        <p><h4>$nome:</h4> $descrizione</p>
                        <img src='.$foto' />
                    </div>"
                ;
        }
        
        pg_close($dbconn);
    }
?>