<?php
    session_start();

    
    if(!isset($_SESSION['id'])){

        header("Location: ../html/login.html");
    }
    
    // Per mostrare il nome dell'utente loggato, come faremo??
    $nome_amministratore = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>SWS - Amministratore</title>

    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>

    <!-- Boostrap Icons -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css'>


    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'
        integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM'
        crossorigin='anonymous'></script>

    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'
        integrity='sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p'
        crossorigin='anonymous'></script>

    <!-- Per le icone delle frecce -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />


    <!-- Per JQuery -->
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'
        integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=' crossorigin='anonymous'></script>


    <!-- Per il counter -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>


    <!-- Per il nostro foglio di stile -->
    <link rel='stylesheet' type='text/css' href='../css/style.css'>
    <link rel='stylesheet' type="text/css" href='../css/iniziative.css'>
    <link rel='stylesheet' type='text/css' href='../css/faq.css'>
    <link rel='stylesheet' type='text/css' href='../css/notifiche.css'>


    <script src="../javascript/utility.js"></script>
    <script src="../javascript/validaInsertEventoIntoDB.js"></script>
    <script src="../javascript/validaInsertFaqIntoDB.js"></script>
    <script src="../javascript/amministrazione.js"></script>
    <script src="../javascript/faq.js"></script>

    <script>
        $(document).ready(function () {
            sliding(".fade-in");

            ancoraTop();

            var nomeAmministratore = <?php echo json_encode($nome_amministratore); ?>;
            $("#nome-utente").html(nomeAmministratore);

            setTimeout('scaricaDati()', 2000);  // Dopo due secondi, scarico i dati dal DB
        });
    </script>

</head>

<body>
    
    <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Navbar -->
    <nav id='navbar' class='navbar navbar-expand-lg navbar-light bg-light'>
        <div class='container'>

            <!-- Da mettere il logo e il collegamento alla home-->
            <img src='../immagini/logo.png' id='logo' alt='logo' />

            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'
                aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>

                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav ms-auto'>

                    <li class='nav-item'>
                        <a class='nav-link' href='../html/index.html'>Home</a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link' href='../html/chisiamo.html'>Chi Siamo</a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link' href='../html/iniziative.html'>Iniziative</a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link' href='../html/faq.html'>FAQ</a>
                    </li>

                    <li class='nav-item'>
                        <!-- Da sistemare per poter fare il logout -->
                        <a class='nav-link btn btn-brand' href='./out.php'>Logout</a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>


    <section id="gestore">

        <div class="container justify-content-center pb-5">
            <div class="col-12  fade-in text-center">
                <h4 class="display-4">Sei loggato come <span id="nome-utente"></span></h4>
            </div>
        </div>
        
        
        <!-- Counter -->
        <div class="counter-up p-5 m-5">
            <div class="content">

                <div class="box">
                    <div class="icon"><i class="bi bi-patch-question"></i></div>
                    <div id="n-faq" class="counter"></div>
                    <div class="text">Faq nella pagina</div>
                </div>

                <div class="box">
                    <div class="icon"><i class="bi bi-ticket-detailed"></i></div>
                    <div id="n-ticket" class="counter"></div>
                    <div class="text">Richieste in sospeso</div>
                </div>

                <div class="box">
                    <div class="icon"><i class="bi bi-calendar-event"></i></div>
                    <div id="n-eventi" class="counter"></div>
                    <div class="text">Eventi pubblicati</div>
                </div>

                <div class="box">
                    <div class="icon"><i class="bi bi-envelope-check"></i></div>
                    <div id="n-news" class="counter"></div>
                    <div class="text">Iscritti alla newsletter</div>
                </div>

            </div>
        </div>



        <div class="container justify-content-center py-5">
            <div class="col-12  fade-in text-center">
                <h5 class="display-3">Cosa vuoi fare?</h5>
                <p>Da questa area privata hai la possibilità di aggiungere nuovi eventi e faq alle rispettive aree della
                    pagina.
                    <br>Inoltre, ti è possibile visualizzare tutte le richieste di supporto non ancora chiuse.
                </p>

                <div class="row col-12 justify-content-center">
                    <a class="btn btn-brand col-4 p-3 m-3" onclick="return caricaAzione('evento')">Inserisci un evento</a>
                    <a class="btn btn-brand col-4 p-3 m-3" onclick="return caricaAzione('faq')">Inserisci una Faq</a>
                    <a class="btn btn-brand col-4 p-3 m-3" onclick="return caricaAzione('contatti')">Visualizza le richieste</a>
                </div>
            </div>
        </div>

    </section>


    <section id="zonaDinamica">

        <!-- Per caricare la risposta di Ajax -->
        <div id="azione-scelta-Ajax"></div>

    </section>


    <!--FOOTER-->
    <footer class='bg-dark text-center text-white' id='footer'>
        <!-- Copyright -->
        <div class='text-center p-3'>
            <p>© 2022 Copyright:</p>
            <a class='text-white'>Progetto LTW - Tarricone, Rodonò</a>
            <a class='text-white' href='https://github.com/rodono-1916563/Student-Web-Support'><i class='bi bi-github'></i></a>
        </div>
    </footer>
</body>

</html>