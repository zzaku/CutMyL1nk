<?php

function connexionBDD()
{
    // Etape 1 : Connexion à la base de données
    // On a besoin de ces infos
    // - Moteur de base de données (MySQL)
    $engine = "mysql";
    // - Hôte (dans notre cas : localhost)
    $host = "localhost";
    // - Port
    $port = 3306; // 3307 pour MariaDB (WAMP), 8889 sur MAMP macOS
    // - Identifiant
    $username = "root";
    // - Mot de passe
    $password = "";
    // - Nom de la base de données (facultatif)
    $dbname = "CutMyL1nk";

    // PDO : PHP Data Objects
    // Connecteur à un SGBDR (ça peut être MySQL, Oracle, SQL Server, ...)
    // PDO a besoin d'un DSN (Data Source Name)
    //$pdo = new PDO("mysql:host=localhost:3306;dbname=sakila", "root", "");
    $pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    return $pdo;
}

function generateShortUrl() {
    $bytes = random_bytes(3); // 3 bytes = 24 bits = 2^24 possibilités
    $shortUrl = bin2hex($bytes);
    return $shortUrl;
  }

?>