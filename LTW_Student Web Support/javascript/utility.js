function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const notifica = formControl.querySelector('.notifica');
    formControl.className = 'form-control error';
    notifica.innerText = message;
}


function setSuccessFor(input) {
    ripulisci(input);
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}

function ripulisci(input) {
    const notifica = input.parentElement.querySelector('.notifica');
    if (notifica.innerText !== '') {
        notifica.innerText = "";
    }
}

function isEmail(email) {
    return /^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/.test(email);
}

// Per poter fare il toggle sui bottoni Read More degli eventi
function mostraDiPiù(id) {
    var nomeBtn = "#show-text-" + id;
    var testo = $(nomeBtn).text();

    if (testo === "Nascondi") {
        $(nomeBtn).text("Read More");
    }
    else {
        $(nomeBtn).text("Nascondi");
    }

    $(nomeBtn).prev().toggle();
    return true;
}


// Per realizzare le animazioni
function sliding(classe) {
    // Tutti gli elementi che devono essere animati
    const sliders = document.querySelectorAll(classe);

    // Le proprietà per l'animazione
    const appearOptions = {
        threshold: 0,                       // Per mostrare il contenuto appena ci si passa sopra durante lo scrolling
        rootMargin: "0px 0px -250px 0px"    
    };

    // Istanziamo un Osservatore con la propria funzione di CallBack
    const appearOnScroll = new IntersectionObserver(function (entries, appearOnScroll) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;

                // Se l'osservatore intercetta l'entry, la facciamo apparire
            } else {
                entry.target.classList.add("appear");
                appearOnScroll.unobserve(entry.target);
            }
        });
    },
        appearOptions);

    // L'Osservatore viene messo ad osservare ogni slider
    sliders.forEach(slider => {
        appearOnScroll.observe(slider);
    });
}

// Funzione per avere un'ancora all'inizio della pagina
function ancoraTop() {

    window.onscroll = function (){
        scrollFunction();
    };

    $("#btn-back-to-top").click(function(){
        backToTop();
    });
}

function scrollFunction() {
    if (document.body.scrollTop > 5 || document.documentElement.scrollTop > 5)
        $("#btn-back-to-top").css('display', "block");

    else
        $("#btn-back-to-top").css('display', "none");
}

function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
