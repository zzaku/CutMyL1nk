<?php
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
                <li><a href="<?= $url ?>"><?= $libelle ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="logo">
            <img src="./inc/assets/logo.png" height="250px" alt="Logo du site">
        </div>
        <div class="account">
            <a href="#">Mon compte</a>
        </div>
    </nav>
</header>