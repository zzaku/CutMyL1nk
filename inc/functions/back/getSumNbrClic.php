<?php

    require_once('./inc/functions/back/functions.php');

    $pdo = connexionBDD();

    $messageNbrClic = null;

    if(isset($_SESSION['userId'])){
        
        $currentIdUser = $_SESSION['userId'];

//-----------------------------------------------------------------------------------------------------------------

        // Select les short urls si il en existe déja
        $stmt = $pdo->prepare('SELECT SUM(clic) FROM urls WHERE user_id = :user_id');
        $stmt->execute(array(
                'user_id' => $currentIdUser,
            ));

        // Récupération du nombre de résultats correspondant à la requête
        $myClics = $stmt->fetch();
            
//-----------------------------------------------------------------------------------------------------------------
        if($myClics){
            if(intval($myClics[0]) < 1){
                $messageNbrClic = "Vous n'avez aucun clic pour le moment";
            } else {
                $messageNbrClic = intval($myClics[0]);
            }
        }
    }

    return [$messageNbrClic]
?>