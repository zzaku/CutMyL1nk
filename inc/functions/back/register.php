<?php

function register() 
{
    require_once('./inc/functions/back/functions.php');
    $pdo = connexionBDD();

    $message = null;

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    // Si la page a été demandée en POST (donc si le formulaire est soumis)
    if ($methode == "POST") {
        
        $username = filter_input(INPUT_POST, "username");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword");
        
        if(isset($username) && isset($email) && isset($password) && isset($confirmPassword)){

            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            if(strlen($password) < 8) {
                $message = "Votre mot de passe est trop court !";
            }

            if ($password != $confirmPassword) {
                $message = "Les mots de passe ne correspondent pas !";
            } else {

//-----------------------------------------------------------------------------------------------------------------

                // Select l'utilisateur correspondant au pseudo si il y'en a
                $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
                $stmt->execute(array(
                    'username' => $username,
                ));
                // Récupération du nombre de résultats correspondant à la requête
                $resultatUsername = $stmt->fetchColumn() > 0;

//-----------------------------------------------------------------------------------------------------------------

                // Select l'utilisateur correspondant à l'adresse mail si il y'en a
                $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
                $stmt->execute(array(
                    'email' => $email,
                ));
                // Récupération du nombre de résultats correspondant à la requête
                $resultatEmail = $stmt->fetchColumn() > 0;

//-----------------------------------------------------------------------------------------------------------------

//------------- Vérification si le pseudo existe déjà ou non ----------------------------------------

                if ($resultatUsername && !$resultatEmail) {
                    $message = 'Ce pseudo est déjà utilisé.';
                } else if (!$resultatUsername && $resultatEmail) {
                    $message = 'Cette adresse mail est déjà utilisé.';
                } else if ($resultatUsername && $resultatEmail) {
                    $message = 'Ce pseudo et cette adresse mail sont déjà utilisés.';
                } else {

                // Si le pseudo et l'adresse mail n'existent pas
                // Insert l'utilisateur dans la bdd
                    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
                    $stmt->execute(array(
                        'username' => $username,
                        'email' => $email,
                        'password' => $passwordHashed,
        
                    ));
                    $message = "Inscription réussi !";
                }
            }
        }

    }
    return [$message];
}
?>