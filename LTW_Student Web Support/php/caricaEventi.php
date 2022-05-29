<?php

    if(isset($_POST['request']) && isset($_POST['query']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        // 
        $tipologia_query = $_POST['query'];
        
        $select = '';
        switch ($tipologia_query) {
            case 'limit':
                $select = "SELECT * FROM eventi ORDER BY giorno DESC LIMIT 3";
                break;
            
            case 'select-all':
                $select = "SELECT * FROM eventi";
                break;
            default:
                exit();
        }

        $result = pg_query($dbconn, $select);

        while($row = pg_fetch_array($result))
        {
            $id = $row['id'];
            $nome = $row['nome'];
            $descrizione = $row['descrizione'];
            $luogo = $row['luogo'];
            $data = $row['giorno'];
            $ora = $row['ora'];
            $foto = $row['foto'];

            echo    "<div class='col-lg-4 col-md-6'>
                        <div class='blog-post custom-card'>
                            <img src='.$foto' alt=''>
                            <div class='blog-post-content'>
                                <h3>$nome</h3>
                                <p>$descrizione</p>

                                <div>
                                    <div class='testo-nascosto'>
                                        <p>Luogo: $luogo<br>
                                            Data: $data<br>
                                            Dalle ore: $ora<br>
                                        </p>
                                    </div>
                                    <a id='show-text-$id' class='custom-link show-text' onclick='return mostraDiPiù($id)'>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>"
            ;
        }

        // echo json_encode($response);
        pg_close($dbconn);
    }


?>