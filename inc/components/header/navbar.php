<?php

require_once('./inc/functions/back/register.php');
require_once('./inc/functions/back/login.php');
require_once('./inc/functions/back/logout.php');

$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
$message = "";

    if ($methode == "POST") {

        $submitRegister = filter_input(INPUT_POST, "submitRegister");
        $submitLogin = filter_input(INPUT_POST, "submitLogin");
        $submitLogout = filter_input(INPUT_POST, "submitLogout");

        if(isset($submitRegister) && !isset($submitLogin) && !isset($submitLogout)){
            [$message] = register();
        } else if(!isset($submitRegister) && isset($submitLogin) && !isset($submitLogout)) {
            [$message] = login();
        } else if(!isset($submitRegister) && !isset($submitLogin) && isset($submitLogout)) {
            logout();
        }
    }

$liens = [
    "index.php?page=home" => "Accueil",
    "index.php?page=myShortLink" => "Mes Urls",
];
?>
<header>
  <nav class="banner">
      <div class="links">
          <ul>
              <?php foreach ($liens as $url => $libelle) : ?>
                <?php if(!isset($_SESSION['userId']) && $libelle === 'Mes Urls'): ?>
                <?php else: ?>
                <li><a href="<?= $url ?>"><?= $libelle ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="logo">
            <img src="./inc/assets/logo.png" height="250px" alt="Logo du site">
        </div>
        <div class="account">
            <?php if(isset($_SESSION["userId"])): ?>
                <div class="btn-account-logged-container">
                    <h3><?php echo $_SESSION["username"] ?></h3><a id="btn-account-logged" href="#"><i class="fa fa-user"></i></a>
                    <form class="logout-form" method="POST" action="#">
                        <a id="btn-account-logout" href="#"><i class="logout-icon fas fa-sign-out-alt"></i><input class="input-logout" type="submit" name="submitLogout" value=""></a>
                    </form>
                </div>
            <?php endif; ?>
            <?php if(!isset($_SESSION["userId"])): ?>
                <a id="btn-account" href="#">Mon compte</a>
                <div id="account-container" class="login-box">
                    <div class="btn-module-container">
                        <div id="btn-login">
                            <h3 id="title-login">Login</h3>
                        </div>
                        <div id="btn-register">
                            <h3 id="title-register">Register</h3>
                        </div>
                    </div>
                    <form id="login-form" class="login-form" method="POST" action="">
                        <div class="user-box">
                            <input type="text" name="login" required="true" autocomplete="off" >
                            <label>Email ou username</label>
                        </div>
                        <div class="user-box">
                            <input type="password" name="password" required="true" autocomplete="off" >
                            <label>Password</label>
                        </div>
                        <div class="message-connexion">
                            <h5><?= $message ?></h5>
                        </div>
                        <a href="" class="">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <input type="submit" name="submitLogin" value="Se connecter">
                        </a>
                    </form>
                    <form id="register-form" class="login-form" method="POST" action="">
                        <div class="user-box">
                            <input type="text" name="username" required="true" autocomplete required>
                            <label>Username</label>
                        </div>
                        <div class="user-box">
                            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required="true" autocomplete required>
                            <label>Adresse mail</label>
                        </div>
                        <div class="user-box">
                            <input type="password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" name="password" required="true" autocomplete required>
                            <label>Password</label>
                        </div>
                        <div class="user-box">
                            <input type="password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" name="confirmPassword" required="true" autocomplete required>
                            <label>confirm password</label>
                        </div>
                        <a href="#">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <input type="submit" name="submitRegister" value="s'inscrire">
                        </a>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>