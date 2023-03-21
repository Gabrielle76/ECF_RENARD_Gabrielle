<?php

$dsn = "mysql:host=127.0.0.1;port=3306;dbname=utilisateur";
$username = "Gabi";
$password = "Admin76Gabi@";

try {
    $nom_du_serveur = new PDO($dsn, $username, $password);
    $nom_du_serveur->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>