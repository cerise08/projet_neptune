<?php
session_start();
require_once "db/mariadb.php";

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    $_SESSION['message'] = "Veuillez remplir tous les champs.";
    $_SESSION['type_message'] = "danger";
    header("Location: index.php?page=connecter");
    exit;
}

// Cherche l'utilisateur
$stmt = $dbh->prepare("SELECT * FROM user WHERE email = :email");
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['message'] = "Email ou mot de passe incorrect.";
    $_SESSION['type_message'] = "danger";
    header("Location: index.php?page=connecter");
    exit;
}

// Connexion réussie
$_SESSION['user'] = [
    'id' => $user['id'],
    'nom' => $user['nom'],
    'prenom' => $user['prenom'],
    'email' => $user['email']
];

$_SESSION['message'] = "Connexion réussie !";
$_SESSION['type_message'] = "success";
header("Location: index.php");
exit;