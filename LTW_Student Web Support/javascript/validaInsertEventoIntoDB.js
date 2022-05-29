function validaCaricamentoEvento() {

    $("#insert-eventi").one('submit', function (event) {
        event.preventDefault();

        // Carico i dati da passare al server
        var dati = {
            nome: $("#nome-evento").val(),
            descrizione: $("#descrizione-evento").val(),
            luogo: $("#luogo-evento").val(),
            giorno: $("#data-evento").val(),
            ora: $("#ora-evento").val(),
            immagine: $("#foto-evento").val()
        };

        // Se i dati sono corretti vengono mandati con Ajax
        if (validaDatiEvento(dati)) {
            $.ajax({
                type: "POST",
                url: "../php/insertEventIntoDB.php",
                data: dati,
                dataType: "text",
                enconde: true,
                success: function (res) {
                    riscontro(res);
                }
            });
        }

        return false;
    });
}

// Per mostrare il risultato ritornato dal server;
function riscontro(risposta) {
    $("#res-Ajax").html(risposta);
}

// Per cancellare la notifica che ha mandato il server
function rimuovi() {
    $("#res-Ajax").empty();
}


function isDate(stringa) {
    return /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/.test(stringa);
}

function isOra(stringa) {
    return /^(?:[0-1]\d|[2][0-3]):[0-5]\d$/.test(stringa);
}

// Per verificare che i dati della form sono corretti
function validaDatiEvento(dati) {

    // esito &&= testNomeEvento();
    // esito &&= testDescrizioneEvento();
    // esito &&= testLuogoEvento();
    // esito &&= testDataEvento(); 
    // esito &&= testOrarioEvento(); 
    // esito &&= testImmagineEvento();

    return testNomeEvento() && testDescrizioneEvento() && testLuogoEvento() 
            && testDataEvento() && testOrarioEvento() && testImmagineEvento();
}

function testNomeEvento() {
    var esito = true;
    var nome = document.getElementById("nome-evento");

    // Controllo il nome
    if (nome.value === '') {
        setErrorFor(nome, "Il nome non può essere vuoto!");
        esito = false;
    }
    else
        setSuccessFor(nome);

    return esito;

}

function testDescrizioneEvento() {
    var esito = true;
    var descrizione = document.getElementById("descrizione-evento");

    // Controllo la descrizione
    if (descrizione.value === '') {
        setErrorFor(descrizione, "La descrizione non può essere vuota!");
        esito = false;
    }
    else if (descrizione.value.length < 20) {
        setErrorFor(descrizione, "La descrizione è troppo corta. Sii più esaustivo!");
        esito = false;
    }
    else
        setSuccessFor(descrizione);

    return esito;
}

function testLuogoEvento() {
    var esito = true;
    var luogo = document.getElementById("luogo-evento");

    // Controllo il luogo
    if (luogo.value === '') {
        setErrorFor(luogo, "Il luogo non può essere vuoto!");
        esito = false;
    }
    else if (luogo.value.length < 5) {
        setErrorFor(luogo, "Non è un luogo valido!");
        esito = false;
    }
    else
        setSuccessFor(luogo);

    return esito;
}

function testDataEvento() {
    var esito = true;
    var data = document.getElementById("data-evento");


    // Controllo sulla data
    if (!isDate(data.value)) {
        setErrorFor(data, "Perfavore inserisci una data della forma gg/mm/nnnn valida!");
        esito = false;
    }
    else
        setSuccessFor(data);

    return esito;
}

function testOrarioEvento() {
    var esito = true;
    var ora = document.getElementById("ora-evento");


    // Controllo sull'ora
    if (!isOra(ora.value)) {
        setErrorFor(ora, "Perfavore inserisci un'orario della forma mm:hh valida!");
        esito = false;
    }
    else
        setSuccessFor(ora);

    return esito;
}

function testImmagineEvento() {
    var esito = true;
    var immagine = document.getElementById("foto-evento");


    // Controllo che sia stata selezionata un'immagine
    if (immagine.value === '') {
        setErrorFor(immagine, "Non è stata selezionata alcuna immagine!");
        esito = false;
    }
    else
        setSuccessFor(immagine);

    return esito;
}

// function isPath(stringa) {
//     return /^.\/immagini\/[A-z]+.[A-z]{2,4}$/.test(stringa);
// }

