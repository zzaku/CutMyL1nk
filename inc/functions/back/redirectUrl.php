<?php

    require_once('functions.php');

    $pdo = connexionBDD();
    
    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    
    // Si la page a été demandée en GET (donc si le formulaire est soumis)
    if ($methode == "GET") {

        // Récupération de l'URL demandée
        $url = $_SERVER['REQUEST_URI'];

        // Extraction du segment d'URL après le nom de domaine
        $segments = explode('/', $url);
        $shortUrl = end($segments);

        // Recherche de l'url originale correspondant à l'url raccourcie
        $stmt = $pdo->prepare('SELECT original_url FROM urls WHERE short_url = :short_url');
        $stmt->execute(array(
            'short_url' => $shortUrl,
        ));
        $result = $stmt->fetch();

        if ($result) {
            // Redirection vers l'url originale
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . 'https://' . $result['original_url']);
            exit();
        } else {
            // Si l'url raccourcie n'existe pas, afficher une erreur 404
            http_response_code(404);
            echo "Page introuvable";
        }
    }

?>