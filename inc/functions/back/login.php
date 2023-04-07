<?php

function login() 
{
    require_once('./inc/functions/back/functions.php');
    $pdo = connexionBDD();

    $message = null;

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    // Si la page a été demandée en POST (donc si le formulaire est soumis)
    if ($methode == "POST") {
        
        $login = filter_input(INPUT_POST, "login");
        $password = filter_input(INPUT_POST, "password");
        
        if(isset($login) && isset($password)){

//-----------------------------------------------------------------------------------------------------------------

            // Select l'utilisateur correspondant au pseudo et au mot de passe
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :login OR email = :login');
            $stmt->execute(array(
                'login' => $login,
            ));
            // Récupération du compte utilisateur
            $user = $stmt->fetch();

//------------- Vérification si le compte existe ----------------------------------------

            if (!$user) {
                $message = "Le mot de passe ou l'identifiant est incorret";
            } else {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['userId'] = $user['id'];
                    $_SESSION['userEmail'] = $user['email'];
                    $_SESSION['username'] = $user['username'];
                    $message = "Connexion reussi !";
                    header('Location: ./index.php?page=myShortLink');
                } else {
                    $message = "Le mot de passe ou l'identifiant est incorret";
                }
            }
        }
    }
    return [$message];
}
?>