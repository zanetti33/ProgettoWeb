<?php
//qui si possono mettere funzioni php utili chiamabili ovunque
function funzioneChiamabileOvunque($cond){
    return $cond;
}

function getSuggestedProducts(){
    return null;
}

function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

?>