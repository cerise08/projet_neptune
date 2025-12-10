<?php
// essaye de faire le code qui est dans le bloc try
try {
    // se connecte à la base de données et stocke la connection dans $dbh
    $dbh = new PDO('mysql:host=localhost;dbname=projet_neptune', 'login4453', 'jCbMIueqyCznUue');
} catch (PDOException $e) {
    // comme la connexion n'a pas fonctionné, je stocke null dans $dbh
    $dbh =  null;
}
?>