<?php

function home()
{
    $titre = "CutMyL1nk";
    $paragraphe = "Avec CutMyL1nk, simplifiez vos liens en un clic pour une navigation fluide !";
    $slogan = "Raccourcir vos liens renforce vos connexions !";
    require_once("./pages/home.php");
}

function myShortLink()
{
    $titre = "Mes liens";
    $paragraphe = "retrouvez touts vos liens juste ici";
    require_once("./pages/myShortLink.php");
}

?>