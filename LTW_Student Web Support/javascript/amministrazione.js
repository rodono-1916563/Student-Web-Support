// Per scaricare i dati dal DB
function scaricaDati()
{
    var dati = {
        n_faq: 'faq',
        n_eventi: 'eventi',
        n_contatti: 'contatti',
        n_news: 'newsletter'
    };

    $.ajax({
        type: "POST",
        url: "../php/scaricaDati.php",
        data: dati,
        dataType: "text",
        enconde: true,
        success: function (res) {
            mostraDati(res);
        }
    });

    setTimeout('scaricaDati()', 5000);
}

// Per mostrare i dati scaricati dal DB
function mostraDati(risposta)
{
    var json = JSON.parse(risposta);

    $("#n-ticket").html(json['n_ticket']);
    $("#n-faq").html(json['n_faq']);
    $("#n-eventi").html(json['n_eventi']);
    $("#n-news").html(json['n_news']);
}

// Per caricare in modo asincrono i documenti che permettono di fare le azioni riservate
// agli amministratori
function caricaAzione(azione) {
    var file;
    if (azione === 'evento')
        file = 'inserisciEvento.html';

    else if (azione === 'faq')
        file = 'inserisciFaq.html';
    
    else if(azione === 'contatti') {
        caricaRichiesta();
        return;
    }

    $.ajax({
        url: "../documenti/" + file,
        method: "GET",
        dataType: "html",

        success: function (response) {
            gestisciResponse(response);
        }
    });

}

function gestisciResponse(risposta) {

    if ($("#azione-scelta-Ajax").html() != '')
    {
        $("#azione-scelta-Ajax").empty();
        $("#azione-scelta-Ajax").html(risposta);
    }
    else
        $("#azione-scelta-Ajax").html(risposta);
}


function caricaRichiesta(){

    if ($("#azione-scelta-Ajax").html() != '') {
        $("#azione-scelta-Ajax").empty();
    }

    $.ajax({
        url: "../php/scaricaRichiesteFromDB.php",
        method: "POST",
        data: { request: "fetchall" },
        dataType: "html",

        success: function (response) {
            insertRichiesta(response);
        }
    });
}

function insertRichiesta(response) {
    $("#azione-scelta-Ajax").append(response);
}