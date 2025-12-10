<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=projet-neptune', 'login4441', 'WKNOONYSJfxbTQS');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>