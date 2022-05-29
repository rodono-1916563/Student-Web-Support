// Per inizializzare lo swiper
function inizializzaSwiperCube() {
    var swiper = new Swiper(".swiper-aule", {
        effect: "cube",
        grabCursor: true,
        loop: true,
        autoplay: {
            delay: 7500,
            disableOnInteraction: false,
        },
        cubeEffect: {
            shadow: true,
            slideShadows: true,
            shadowOffset: 20,
            shadowScale: 0.94,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
}

// // Per caricare dinamicamente dal DB le immagini 
// // e le informazioni degli spazi della Sapienza
function caricaSpaziSapienza() {

    $.ajax({
        url: "../php/caricaSpaziSapienza.php",
        method: "POST",
        data: { request: "fetchall" },
        dataType: "html",

        success: function (response) {
            insertSpazio(response);
        }
    });
}

function insertSpazio(response) {
    $("#spazi-Ajax").append(response);
}

// // Per caricare le card dal DB in modo dinamico
function caricaCardFromDB(tipologiaQuery) {

    var pack = {
        request: "fetchall",
        query: tipologiaQuery
    };

    $.ajax({
        url: "../php/caricaEventi.php",
        method: "POST",
        data: pack,
        dataType: "html",

        success: function (res) {
            caricaCardHome(res);
        }
    });
}

function caricaCardHome(card) {
    $("#limit-card-Ajax").append(card);
}