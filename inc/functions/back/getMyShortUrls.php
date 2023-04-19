<?php

    require_once('./inc/functions/back/functions.php');

    $pdo = connexionBDD();

    $message = null;
    if(isset($_SESSION['userId'])){
        
        $currentIdUser = $_SESSION['userId'];
        
        //-----------------------------------------------------------------------------------------------------------------
        
        // Select les short urls si il en existe déja
        $stmt = $pdo->prepare('SELECT * FROM urls WHERE user_id = :user_id');
        $stmt->execute(array(
            'user_id' => $currentIdUser,
        ));
        
        // Récupération du nombre de résultats correspondant à la requête
        $myShortUlrs = $stmt->fetchAll();

//-----------------------------------------------------------------------------------------------------------------
        if(!$myShortUlrs){
            $message = "Vous n'avez aucun lien raccouci pour le moment";
        } //else {
            // Si j'utilise l'url raccourci comme source pour l'iframe alors
            // J'enlève un clic dans la bdd pour chaque lien car les iframes ajoutent automatiquement un clic lorsqu'ils chargent l'aperçu de la page
            /*foreach($myShortUlrs as $shortUlr){
                $stmt = $pdo->prepare('UPDATE urls SET clic = clic - 1 WHERE short_url = :short_url AND user_id = :user_id');
                $iframeClicked = $stmt->execute(array(
                    'short_url' => $shortUlr['short_url'],
                    'user_id' => $currentIdUser,
                ));
            }*/
        //}
    }

    return [$myShortUlrs]
?>