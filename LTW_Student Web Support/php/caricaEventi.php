<?php

    if(isset($_POST['request']) && isset($_POST['query']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $tipologia_query = $_POST['query'];
        
        $select = '';
        switch ($tipologia_query) {
            case 'limit':
                $oggi = "". date("Y/m/d");
                $select = "SELECT * FROM eventi ORDER BY (SELECT DATE_PART('day', giorno::date) - DATE_PART('day', NOW()::date)) DESC LIMIT 3";
                break;
            
            case 'select-all':
            case 'delete-evento':
                $select = "SELECT * FROM eventi";
                break;

            default:
                exit();
        }

        $result = pg_query($dbconn, $select);
        $div = '';

        // Se è una delete-query, siamo in amministrazione. Pertanto mostriamo il titolo dell'azione
        if ($tipologia_query == 'delete-evento') {
            $div = $div .   "<div class='container'>
                                <div class='container justify-content-center pb-4'>
                                    <div class='col-12 text-center'>
                                        <h6 class='display-4 bold'>Scegli quale evento eliminare:</h6>
                                    </div>
                                </div>
                            </div>"
                        ;
        }

        while($row = pg_fetch_array($result))
        {
            $id = $row['id'];
            $nome = $row['nome'];
            $descrizione = $row['descrizione'];
            $luogo = $row['luogo'];
            $data = $row['giorno'];
            $ora = $row['ora'];
            $foto = $row['foto'];

            // Ricostruisco la data nel formato italiano
            $anno_mese_giorno = explode('-', $data);
            $anno = $anno_mese_giorno[0];
            $mese = $anno_mese_giorno[1];
            $giorno = $anno_mese_giorno[2];

            $div = $div .  "<div class='col-lg-4 col-md-6'>
                                <div class='blog-post custom-card'>
                                    <img src='.$foto' alt=''>
                                    <div class='blog-post-content'>
                                        <h3>$nome</h3>
                                        <p>$descrizione</p>

                                        <div>
                                            <div class='testo-nascosto'>
                                                <p>Luogo: $luogo<br>
                                                    Data: $giorno-$mese-$anno<br>
                                                    Dalle ore: $ora<br>
                                                </p>
                                            </div>
                                            <a id='show-text-$id' class='custom-link show-text' onclick='return mostraDiPiù($id)'>Read more</a>";

            // Se si deve poter eliminare un evento, aggiungo il pulsante per eliminarlo
            if ($tipologia_query == 'delete-evento')
                $div = $div . "<div class='pt-3'><a id='delete-event-$id' class='custom-link show-text btn btn-brand' onclick='return eliminaEvento($id)'>Delete</a></div>";
            
            
            $div = $div .         "</div>
                            </div>
                        </div>
                    </div>"
                    ;
        }

        echo    "<div id='blog' class='container'>" .
                    "<div id='riga-blog' class='row'>$div</div>" .
                "</div>";

        pg_close($dbconn);
    }


?>