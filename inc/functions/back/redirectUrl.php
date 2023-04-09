<?php

//----------------------------------------------------------------- En retirant ces header, l'incrémentation du click se fait seule fois par navigateur ------------------------
//------------------------------------------------------------------- à moins de vider le cache, et ce pour éviter le spam ------------------------------------------------------------
    //header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');
    //header('Cache-Control: no-cache, must-revalidate, max-age=0');
    //header('Pragma: no-cache');

    require_once('functions.php');

    $pdo = connexionBDD();
    
    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    
    // Si la page a été demandée en GET (donc si le formulaire est soumis)
    if ($methode == "GET") {

        // Récupération de l'URL demandée
        $url = $_SERVER['REQUEST_URI'];

        // Extraction du segment d'URL après le nom de domaine
        $segments = array_splice(explode('/', $url), -2);
        $shortUrl = $segments[0] . '/' . $segments[1];
        $idUser = substr($segments[1], 6);

        // Recherche de l'url originale correspondant à l'url raccourcie
        $stmt = $pdo->prepare('SELECT original_url FROM urls WHERE short_url = :short_url');
        $stmt->execute(array(
            'short_url' => $shortUrl,
        ));
        $result = $stmt->fetch();

        if ($result) {
            

            // Mettre à jour le nombre de clics pour cette URL raccourcie
            $stmt = $pdo->prepare('UPDATE urls SET clic = clic + 1 WHERE short_url = :short_url AND user_id = :user_id');
            $clicked = $stmt->execute(array(
                'short_url' => $shortUrl,
                'user_id' => $idUser,
            ));

            if($clicked){
                // Redirection vers l'url originale
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: ' . 'https://' . $result['original_url']);
                exit();
            }

        } else {
            // Si l'url raccourcie n'existe pas, afficher une erreur 404
            http_response_code(404);
            echo "Page introuvable";
        }
    }

?>