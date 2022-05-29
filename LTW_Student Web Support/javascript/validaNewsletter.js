
function validaNewsletter(){

    $("#newsletter").submit(function (event) {
        event.preventDefault();
    
        var email = {
            email: $("#newsletter-email").val()
        };
    
        $.ajax({
            type: "POST",
            url: "../php/newsletter.php",
            data: email,
            dataType: "text",
            enconde: true,
            success: function (res) {
                appendRes(res);
            }
        });
    });
}

function appendRes(risposta) {
    $("div.news-resAjax").html(risposta);
}

function rimuovi() {
    $("div.news-resAjax").empty();
}