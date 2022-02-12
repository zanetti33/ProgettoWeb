$(document).ready(function(){
    // allo stato iniziale solo la prima immagine è visibile
    $("main > section > div:nth-of-type(3) > img").hide();
    var $shownImage = $("main > section > div:nth-of-type(2) > img")
        .show()
        .addClass("shown");
    
    //funzionamento al click di prev
    $("main > section > div:nth-of-type(1) > img").click(function() {
        $shownImage
            .removeClass("shown")
            .hide();
        if ($shownImage.index()) {
            $shownImage = $shownImage
                .prev()
                .show()
                .addClass("shown");
        } else {
            $shownImage = $("main > section > div:nth-of-type(2) > img")
                .show()
                .addClass("shown");
        }
    });

    //funzionamento al click di next
    $("main > section > div:last-of-type > img").click(function() {
        $shownImage
            .removeClass("shown")
            .hide();
        if ($shownImage.index() != $("main > section > div:nth-of-type(2) > img").length - 1) {
            $shownImage = $shownImage
                .next()
                .show()
                .addClass("shown");
        } else {
            $shownImage = $("main > section > div:nth-last-of-type(2) > img")
                .show()
                .addClass("shown");
        }
    });

    //funzionamento click di un'immagine (non funziona sul mio chrome :C)
    $("main > section:last-child > div > img").click(function() {
        var $id = $(this).attr("alt");
        window.location = `singolo-prodotto.php?idMaglia=${$id}`;
    });
});
