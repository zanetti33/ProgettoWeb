<?php
//qui si possono mettere funzioni php utili chiamabili ovunque
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

function isUserLoggedIn(){
    return !empty($_SESSION['idautore']);
}

function toTag($word){
    return preg_replace("/[^a-z]/", '', strtolower($word));
}
?>