
// Per caricare le card dal DB in modo dinamico
function caricaCardIniziative(tipologiaQuery) {

    var pack = {
        request: "fetchall",
        query: tipologiaQuery
    };

    
    $.ajax({
        url: "../php/caricaEventi.php",
        method: "POST",
        data: pack,
        dataType: "html",

        success: function (response) {
            insertCard(response);
        }
    });
}

function insertCard(response) {
    $("#card-Ajax").append(response);
}


// Per caricare le certificazioni presenti nel DB in modo dinamico
function caricaCertificazioni(){

    $.ajax({
        url: "../php/caricaCertificazioniFromDB.php",
        method: "POST",
        data: {request: "fetchall"},
        dataType: "html",

        success: function (response) {
            insertCertificazioni(response);
        }
    });
}

function insertCertificazioni(response) {
    $("#corsi-Ajax").append(response);
}


// Per inizializzare lo Swiper del carosello
function inizializzaSwyperCarousel() {
    var swiper = new Swiper(".mySwiper",
        {
            // slidesPerView: 3,
            spaceBetween: 30,
            slidesPerGroup: 3,
            loop: true,
            grabCursor: true,
            loopFillGroupWithBlank: false,
            autoplay: {
                delay: 7500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                1100: {
                    slidesPerView: 3
                },
                900: {
                    slidesPerView: 2
                },
                700: {
                    slidesPerView: 1
                },
                0: {
                    slidesPerView: 1
                }
            }
        });
}