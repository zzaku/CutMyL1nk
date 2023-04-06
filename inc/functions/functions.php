<?php
// B : le fichier de fonctions
// Appelé par index.php
// Liste les fonctions utilisées dans le site
function home()
{
    // D : Fonction de la page a.php
    // Appelée par le routeur (inc/router.php)
    // Déclare les variables
    // Appelle le fichier "HTML" de la page
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