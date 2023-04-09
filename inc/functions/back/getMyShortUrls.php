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
        }
    }

    return [$myShortUlrs]
?>