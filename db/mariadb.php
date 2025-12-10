<?php
try {
<<<<<<< HEAD
    $dbh = new PDO('mysql:host=localhost;dbname=projet-neptune', 'login4441', 'WKNOONYSJfxbTQS');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
=======
    // se connecte à la base de données et stocke la connection dans $dbh
    $dbh = new PDO('mysql:host=localhost;dbname=projet_neptune', 'login4440', 'DHkvoIIqoichfZO');
>>>>>>> dee33e5cd7ea520fbc26093f04c4aecdfbda0232
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>