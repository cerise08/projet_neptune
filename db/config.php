<?php
// config.php
$db_host = 'localhost';
$db_name = 'projet-neptune';
$db_user = 'ton_user';
$db_pass = 'ton_motdepasse';

try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
