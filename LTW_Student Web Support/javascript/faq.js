
// Pe usare la accordion sulle faq
function mostraRisposta(id) {
    var nomeBtn = "#btn-" + id;

    $(nomeBtn).next().toggleClass('show');        // Per mostrare il contenuto di <p>
    $(nomeBtn + ' > i').toggleClass('rotate');   // Per ruotare la freccia

    return true;
}

// Per caricare le faq in modo dinamico
function caricaFaq(){

    $.ajax({
        url: "../php/caricaFaq.php",
        method: "POST",
        data: { request: "fetchall" },
        dataType: "html",

        success: function (response) {
            insertFaq(response);
        }
    });
}

function insertFaq(response) {
    $("#faq-Ajax").append(response);
}
