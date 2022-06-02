// Per scaricare i dati dal DB
function scaricaDati() {
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
function mostraDati(risposta) {
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
    if (azione === 'insert-evento')
        file = 'inserisciEvento.html';

    else if (azione === 'insert-faq')
        file = 'inserisciFaq.html';

    else if (azione === 'contatti') {
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

    if ($("#azione-scelta-Ajax").html() != '') {
        $("#azione-scelta-Ajax").empty();
        $("#azione-scelta-Ajax").html(risposta);
    }
    else
        $("#azione-scelta-Ajax").html(risposta);
}


function caricaRichiesta() {

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

// Per eliminare una faq oppure un evento
function caricaEliminazione(azione) {
    var script;
    if (azione === 'delete-evento')
        script = '../php/caricaEventi.php';

    else if (azione === 'delete-faq')
        script = '../php/caricaFaq.php';

    else
        return;

    var pack = {
        request : "fetchall",
        query : azione
    };

    $.ajax({
        url: script,
        data: pack,
        method: "POST",
        dataType: "html",

        success: function (response) {
            mostraTuttiEventi(response);
        }
    });
}

// Per mostrare tutti gli eventi
function mostraTuttiEventi(risposta) {

    if ($("#azione-scelta-Ajax").html() == ''){
        $("#azione-scelta-Ajax").append(risposta);
    }

    else if ($("#azione-scelta-Ajax").html() != '') {
        $("#azione-scelta-Ajax").empty();
        $("#azione-scelta-Ajax").append(risposta);
    }

}

// Per cancellare dal DB un evento al click sul relativo bottone
function eliminaEvento(id) {

    var pack = {
        request : "fetchall",
        id_card : id
    };

    $.ajax({
        url: "../php/eliminaEventoFromDB.php",
        method: "POST",
        data: pack,
        dataType: "html",

        success: function (response) {
            eliminaEventoFromDB(response);
        }
    });
}

// Per mostrare il risultato dato dall'eliminazione dell'evento dal DB
function eliminaEventoFromDB(response) {
    // $("#azione-scelta-Ajax").append(response);
    window.location.reload();
}


// Per cancellare dal DB una faq al click sul relativo bottone
function eliminaFaq(id) {

    var pack = {
        request : "fetchall",
        id_faq : id
    };

    $.ajax({
        url: "../php/eliminaFaqFromDB.php",
        method: "POST",
        data: pack,
        dataType: "html",

        success: function (response) {
            eliminaFaqFromDB(response);
        }
    });
}

// Per mostrare il risultato dato dall'eliminazione della faq dal DB
function eliminaFaqFromDB(response) {
    // $("#azione-scelta-Ajax").append(response);
    window.location.reload();
}