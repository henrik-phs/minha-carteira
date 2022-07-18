var x = 0;

function menuDesktop() {
    var wdt = $(window).width();
    var widthMobile = 75;
    var wdtM = widthMobile + 20;
    var widthDesktop = 250;

    if (x == 0) { // VERIFICA SE O BOTÃO FOI CLICADO
        $(".nav-topo").css({
            "width": wdt - wdtM,
            "margin-left": widthMobile
        });
        $(".nav-lateral").css({
            "width": widthMobile + "px"
        });
        $(".conteudo").css({
            "width": wdt - wdtM,
            "margin-left": widthMobile
        });
        $(".txt-menu").hide("slow");
        x = 1;
    } else {
        $(".nav-topo").css({
            "width": wdt - widthDesktop,
            "margin-left": widthDesktop
        });
        $(".nav-lateral").css({
            "width": widthDesktop + "px"
        });
        $(".conteudo").css({
            "width": wdt - widthDesktop,
            "margin-left": widthDesktop
        });
        $(".txt-menu").show();
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