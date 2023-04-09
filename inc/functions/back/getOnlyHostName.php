<?php

$url = 'https://' . $shortUlr['original_url'];

$host = parse_url($url, PHP_URL_HOST);
$hostParts = explode(".", $host);

// Retirer "www" si présent
if($hostParts[0] == "www"){
    array_shift($hostParts);
}

// Récupérer le premier élément restant
$domain = $hostParts[0];

?>