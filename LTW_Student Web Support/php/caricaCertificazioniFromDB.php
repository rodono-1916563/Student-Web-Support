<?php

    if(isset($_POST['request']))
    {
        $dbconn = pg_connect('host=localhost port=5433 dbname=ProgettoLTW user=admin password=password');

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }
        
        $select = 'SELECT * FROM certificazioni';
        $result = pg_query($dbconn, $select);


        while($row = pg_fetch_array($result))
        {
            // $id = $row['id'];
            $nome = $row['nome'];
            $descrizione = $row['descrizione'];
            $contatto = $row['contatto'];
            $immagine = $row['immagine'];

            echo    "<div class='swiper-slide card'>
                        <div class='blog-post custom-card'>
                            <img src='$immagine' alt=''>
                            <div class='blog-post-content'>
                                <h3>$nome</h3>
                                <p>$descrizione</p>
                                <a class='custom-link'>$contatto</a>
                            </div>
                        </div>
                     </div>"
                ;
        }

        pg_close($dbconn);
    }
?>