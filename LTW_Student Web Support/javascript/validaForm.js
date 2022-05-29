
function validaContattaci() {
    var esito = true;
    // trim to remove the whitespaces
    var email = document.getElementById('idEmail');
    var emailValue = email.value.trim();

    var oggetto = document.getElementById('idOggetto');
    var descrizione = document.getElementById('idDescrizione');

    if (emailValue === '') {
        setErrorFor(email, "L'email non può essere vuota!");
        esito = false;
    }
    else if (!isEmail(emailValue)) {
        setErrorFor(email, "Perfavore, inserisci un'email valida!");
        esito = false;
    }
    else {
        setSuccessFor(email);
    }

    if (oggetto.value === '') {
        setErrorFor(oggetto, "L'oggetto non può essere vuoto!");
        esito = false;
    }
    else if (oggetto.value.length < 10)
    {
        setErrorFor(oggetto, "L'oggetto è troppo corto, prova a spiegarti meglio!");
        esito = false;
    }
    else {
        setSuccessFor(oggetto);
    }

    if (descrizione.value === '') {
        setErrorFor(descrizione, "La descrizione non può essere vuota!");
        esito = false;
    }
    else if (descrizione.value.length < 20)
    {
        setErrorFor(descrizione, "La descrizione è troppo corta. Perfavore descrivici meglio la situazione!");
        esito = false;
    }
    else {
        setSuccessFor(descrizione);
    }

    return esito;

}
