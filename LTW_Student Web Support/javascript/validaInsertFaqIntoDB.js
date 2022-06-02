
function validaCaricamentoFaq() {

    $("#insert-faq").one('submit', (function (event) {
        event.preventDefault();

        // Carico i dati da passare al server
        var dati = {
            domanda: $("#domanda-faq").val(),
            risposta: $("#risposta-faq").val(),
        };


        // Se i dati sono corretti vengono mandati con Ajax
        if (validaDatiFaq(dati)) {
            $.ajax({
                type: "POST",
                url: "../php/insertFaqIntoDB.php",
                data: dati,
                dataType: "text",
                enconde: true,
                success: function (res) {
                    notifica(res);
                }
            });
        }

        return false;
    }));
}

// Per mostrare il risultato ritornato dal server;
function notifica(risposta) {
    $("#res-faq-Ajax").html(risposta);
}

// Per cancellare la notifica che ha mandato il server
function rimuoviAlert() {
    $("#res-faq-Ajax").empty();
}

function validaDatiFaq() {
    var esito = true;
    var domanda = document.getElementById("domanda-faq");
    var risposta = document.getElementById("risposta-faq");

    // Controllo la domanda
    if (domanda.value === '') {
        setErrorFor(domanda, "La domanda non può essere vuota!");
        esito = false;
    }
    else if (domanda.value.length < 20) {
        setErrorFor(domanda, "La domanda è troppo corta. Descrivi meglio la situazione!");
        esito = false;
    }
    else
        setSuccessFor(domanda);
        

    // Controllo la risposta
    if (risposta.value === '') {
        setErrorFor(risposta, "La risposta non può essere vuota!");
        esito = false;
    }
    else if (risposta.value.length < 20) {
        setErrorFor(risposta, "La risposta è troppo corta. Sii più esaustivo!");
        esito = false;
    }
    else
        setSuccessFor(risposta);


    return esito;
}