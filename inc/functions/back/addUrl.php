<?php

function addUrl() 
{
    require_once('./inc/functions/back/functions.php');

    $pdo = connexionBDD();

    $message = null;
    $fullShortUrl = "";

    $regexUrl = "/^(http(s)?:\/\/)?(www.)?([a-zA-Z0-9])+([\-\.]{1}[a-zA-Z0-9]+)*\.[a-zA-Z]{2,5}(:[0-9]{1,5})?(\/[^\s]*)?$/m";

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    // Si la page a été demandée en POST (donc si le formulaire est soumis)
    if ($methode == "POST") {
        
        $url = filter_input(INPUT_POST, "url");

        $isValidUrl = preg_match($regexUrl, $url);
        $isShort = false;

        if(isset($_SESSION['userId'])){
        
            $currentIdUser = $_SESSION['userId'];

            if(isset($url)){

//-----------------------------------------------------------------------------------------------------------------

                //Raccourcissement de l'url
                if($isValidUrl){

                    $url = preg_replace(
                        '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i',
                        "$3",
                        $url
                      );

//-----------------------------------------------------------------------------------------------------------------

                    // Select l'url si elle existe déja
                    $stmt = $pdo->prepare('SELECT id FROM urls WHERE original_url = :original_url AND user_id = :user_id');
                    $stmt->execute(array(
                        'original_url' => $url,
                        'user_id' => $currentIdUser,
                    ));
                    // Récupération du nombre de résultats correspondant à la requête
                    $resultatEmail = $stmt->fetchColumn() > 0;

//-----------------------------------------------------------------------------------------------------------------

                    if($resultatEmail){
                        $message = "L'URL entrée à déja été raccourcis !";
                    } else {

                        $shortUrl = generateShortUrl();
                        $fullShortUrl = 'cutmy.l1nk/' . $shortUrl . $_SESSION['userId'];

                        // Select l'utilisateur correspondant au pseudo et au mot de passe
                        $stmt = $pdo->prepare('INSERT INTO urls (user_id, original_url, short_url) VALUES (:user_id, :original_url, :short_url)');
                        $stmt->execute(array(
                            'user_id' => $currentIdUser,
                            'original_url' => $url,
                            'short_url' => $fullShortUrl,
                        ));

                        $message = "URL raccourcie : <a style='color: #16a085' href=" . $fullShortUrl . ">" . "CutMyLink/" . $fullShortUrl . "</a>";
                        $isShort = true;
                    }

                } else {
                    $message = "L'URL entrée n'est pas valide";
                }

            } else {
                $message = "Veuillez entrer une URL à raccourcir !";
            }

        } else {
            $message = "Connectez-vous avant de raccourcir votre lien !";
        }
    }
    return [$message, $isShort];
}
?>