<?php
require_once 'bootstrap.php';

//se non loggato o admin
if(empty($_SESSION["email"]) || 
    $_SESSION["admin"]){
    header("location: login.php");
}

if(isset($_POST["acquista"])){
    //eventuali controlli sui valori

    //controllo che ci sia qualcosa nel carrello
    if(count($templateParams["maglie"]) == 0){
        $msg = "il carrello è vuoto, nulla da acquistare!";
    }else{
        //controllo che i prodotti siano ancora disponibili
        $ok = true;
        foreach($templateParams["maglie"] as $maglia){
            $id = $maglia["idMaglia"];
            $result1 = $dbh->stock($id);
            $n = $dbh->numberOfProductInCart($id, $_SESSION["email"]);
            if(count($result1) == 0){
                $msg = "maglie non trovate nel db";
                break;
            } else {
                $disp = $result1[0]["dispMagazzino"];
                if($disp < $n){
                    $magliaNonDisponibile = $dbh->getProductById($id);
                    $ok = false;
                    break;
                }
            }
        }
        if($ok){
            //eseguo l'ordine
            $result = $dbh->executeOrder($email);
            if($result){
                $msg = "errore nel pagamento!";
            }else{
                $msg = "acquisto completato con successo!";
            }
        }else{
            $msg = $magliaNonDisponibile["modello"].$magliaNonDisponibile["colore"].$magliaNonDisponibile["genere"].$magliaNonDisponibile["taglia"]."non è più disponibile in quella quantità!";
        }
    }
    $templateParams["messaggio"] = $msg;
}

//Base Template
$templateParams["titolo"] = "Kits - Carrello";
$templateParams["nome"] = "carrello.php";
//Home Template
$templateParams["maglie"] = $dbh->getProductsInCart($_SESSION["email"]);
if(isset($_GET["msg"])){
    $templateParams["messaggioCarrello"] = $_GET["msg"];
}

require 'template/base.php';
?>