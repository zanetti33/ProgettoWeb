<?php
//qui si possono mettere funzioni php utili chiamabili ovunque

$IMG_DIR = "./img/";

function funzioneChiamabileOvunque($cond){
    return $cond;
}

function getSuggestedProducts(){
    return true;
}

function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

function toTag($word){
    return preg_replace("/[^a-z]/", '', strtolower($word));
}

function getAction($action){
    $result = "";
    switch($action){
        case 1:
            $result = "Inserisci";
            break;
        case 2:
            $result = "Modifica";
            break;
        case 3:
            $result = "Cancella";
            break;
    }

    return $result;
}

?>