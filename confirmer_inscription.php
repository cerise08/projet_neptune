<?php
require_once "db/mariadb.php";
session_start();

$prenom = trim($_POST['prenom'] ?? '');
$nom = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$tel = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';
$terms = isset($_POST['terms']) ? 1 : 0;
$newsletter = isset($_POST['newsletter']) ? 1 : 0;

if (!$prenom || !$nom || !$email || !$password || !$password_confirm || !$terms) {
    $_SESSION['message'] = "Tous les champs obligatoires doivent être remplis et conditions acceptées.";
    $_SESSION['type_message'] = "danger";
    header("Location: index.php?page=inscription");
    exit;
}

if ($password !== $password_confirm) {
    $_SESSION['message'] = "Les mots de passe ne correspondent pas.";
    $_SESSION['type_message'] = "danger";
    header("Location: index.php?page=inscription");
    exit;
}

// Vérifie si email existe déjà
$stmt = $dbh->prepare("SELECT * FROM user WHERE email = :email");
$stmt->execute([':email' => $email]);
if ($stmt->fetch()) {
    $_SESSION['message'] = "Cet email est déjà utilisé.";
    $_SESSION['type_message'] = "danger";
    header("Location: index.php?page=inscription");
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $dbh->prepare("INSERT INTO user (nom, prenom, email, password, role, newsletter, terms, tel) VALUES (:nom, :prenom, :email, :password, 'user', :newsletter, :terms, :tel)");
$stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':password' => $hashed,
    ':newsletter' => $newsletter,
    ':terms' => $terms,
    ':tel' => $tel
]);

// Connexion automatique
$_SESSION['user'] = [
    'id' => $dbh->lastInsertId(),
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email
];

$_SESSION['message'] = "Inscription réussie, vous êtes maintenant connecté(e) !";
$_SESSION['type_message'] = "success";
header("Location: index.php"); // redirige vers home
exit;