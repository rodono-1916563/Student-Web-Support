function validaLogin() {
    var esito = true;
    var username = document.getElementById('idUsername');
    var password = document.getElementById('idPassword');

    if (username.value === '') {
        setErrorFor(username, "Non hai inserito alcun username!");
        esito = false;
    }
    else {
        setSuccessFor(username);
    }

    if (password.value === '') {
        setErrorFor(password, "Non hai inserito la password!");
        esito = false;
    }
    else if (password.value.length < 8) {
        setErrorFor(password, "Ricorda che la password è di almeno 8 caratteri!");
        esito = false;
    }
    else {
        setSuccessFor(password);
    }

    return esito;

}


// Per verificare l'esito del Login
function verificaLogin() {

    $("#formLogin").submit(function (event) {
        event.preventDefault();

        // Fa la validazione dei campi della forma:
        // - se i dati sono validi, facciamo una chiamata ajax
        // - altrimenti, non verrà fatto altro
        if (validaLogin())
        {

            var mess = {
                username: $("#idUsername").val(),
                password: $("#idPassword").val()
            };

            $.ajax({
                type: "POST",
                url: "../php/login.php",
                data: mess,
                dataType: "text",
                enconde: true,
                success: function (res) {
                    appendAlert(res);
                }
            });
        }
    });

    return true;
}

function appendAlert(risposta) {
    // Se l'utente è ammesso al login, verrà redirectato alla sua area privata
    if (risposta === 'valido') {
        window.location.replace('../php/redirectToLogin.php');
    }
    // Altrimenti gli notifico che non può accedere
    else {
        $("#intrusion-Ajax").html(risposta);
    }
}