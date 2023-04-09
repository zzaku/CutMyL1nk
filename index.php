<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CutMyL1nk</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="./inc/components/header/navbar.css">
        <link rel="stylesheet" href="./inc/components/footer/footer.css">
        <link rel="stylesheet" href="./pages/home.css">
        <link rel="stylesheet" href="./pages/myShortLink.css">
        <link rel="stylesheet" href="./inc/components/graph/graph.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Raleway:wght@100&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/72d345e137.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        
    </head>
    <body>
        <?php 
        require_once('./inc/routes/functions.php');
        require_once('./inc/routes/router.php');
        ?>
    </body>
</html>