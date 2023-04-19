<?php

    session_start();

    require_once('functions.php');

    $pdo = connexionBDD();

    $message = null;

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    // Si la page a été demandée en POST (donc si le formulaire est soumis)
    if ($methode == "GET") {
        
        $url = filter_input(INPUT_GET, "url");

        if(isset($_SESSION['userId'])){
        
            $currentIdUser = $_SESSION['userId'];

            if(isset($url)){

                    // Active le lien dans la bdd
                    $stmt = $pdo->prepare('UPDATE urls SET is_active = 1 WHERE short_url = :short_url AND user_id = :user_id');
                    $stmt->execute(array(
                        'short_url' => $url,
                        'user_id' => $currentIdUser,
                    ));
                    header('location: /index.php?page=myShortLink');
                    exit();

                } else {
                    $message = "Il y'a un problème avec votre lien";
                } 
//------------------------------ Si utilisateur non connecté pour une quelconque raison, retour à la page d'accueil ------------------
        } else {
            $message = "Connectez-vous avant de raccourcir votre lien !";
            header('location: /index.php?page=home');
            exit();
        }
    }
    return [$message];
?>