<?php
    if(isset($_POST['request']))
    {
        $dbconn = pg_connect("host=localhost port=5433 dbname=ProgettoLTW user=admin password=password");

        if(!$dbconn){
            die('Could not connect: ' . pg_last_error());
        }

        $tipologia_query = $_POST['query'];

        $select = "SELECT * FROM faq";
        $result = pg_query($dbconn, $select);
        $div = '';

        if ($tipologia_query == 'delete-faq') {
            $div = $div .   "<div class='container'>
                                <div class='container justify-content-center pb-4'>
                                    <div class='col-12 text-center'>
                                        <h6 class='display-4 bold'>Scegli quale faq eliminare:</h6>
                                    </div>
                                </div>
                            </div>"
                        ;
        }

        while($row = pg_fetch_array($result))
        {
            $id = $row['id'];
            $domanda = $row['domanda'];
            $risposta = $row['risposta'];

            $div = $div .   "<div class='question col px-5 mt-2'>
                                <button id='btn-$id' onclick='return mostraRisposta($id)'>";
                                
            // Se si deve poter eliminare una faq, aggiungo il pulsante per eliminarla
            if ($tipologia_query == 'delete-faq')
            $div = $div .           "<i class='fas fa-angle-down d-arrow'></i>
                                     <span>$domanda</span>
                                     <a id='delete-faq-$id' class='px-2 custom-link show-text btn btn-brand' onclick='return eliminaFaq($id)'>Delete</a>"
                    ;

            else
            $div = $div .           "<span>$domanda</span>
                                     <i class='fas fa-angle-down d-arrow'></i>"
                    ;

            $div = $div .       "</button>
                                 <p>$risposta</p>
                            </div>";

        }

        echo $div;

        pg_close($dbconn);

    }

?>