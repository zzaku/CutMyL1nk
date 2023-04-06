<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $titre ?></title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="./inc/components/navbar.css">
        <link rel="stylesheet" href="./inc/components/footer.css">
        <link rel="stylesheet" href="./pages/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Raleway:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php 
        require_once('./inc/functions/functions.php');
        require_once('./inc/routes/router.php');
        ?>
    </body>
</html>