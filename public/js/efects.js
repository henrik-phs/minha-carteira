var x = 0;

function menuDesktop() {
    var wdt = $(window).width();

    if (x == 0) {
        $(".nav-topo").css({
            "width": wdt - 50,
            "margin-left": 50
        });
        $(".nav-lateral").css({
            "width": "50px"
        });
        $(".conteudo").css({
            "width": wdt - 50,
            "margin-left": 50
        });
        x = 1;
    } else {
        $(".nav-topo").css({
            "width": wdt - 250,
            "margin-left": 250
        });
        $(".nav-lateral").css({
            "width": "250px"
        });
        $(".conteudo").css({
            "width": wdt - 250,
            "margin-left": 250
        });
        x = 0;
    }
    console.log(x);
}

function menuMobile() {
    var wdt = $(window).width();

    if (x == 0) {
        $(".nav-lateral, .click-menu-mobile").css({
            "display": "block"
        });
        x = 1;
    } else {
        $(".nav-lateral, .click-menu-mobile").css({
            "display": "none"
        });
        x = 0;
    }
    console.log(x);
}

$("#fechar").click(() => {
    var largura = $(window).width();

    if (largura > 500)
        menuDesktop();
    else
        menuMobile();
});

$(".click-menu-mobile").on('click', function(e) {
    menuMobile();
});