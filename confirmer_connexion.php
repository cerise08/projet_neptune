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

// Connexion réussie : on stocke les infos en session
$_SESSION['user'] = [
    'id' => $user['id'],
    'nom' => $user['nom'],
    'prenom' => $user['prenom'],
    'email' => $user['email'],
    'role' => $user['role']
];

// Redirection selon rôle
if ($user['role'] === 'admin') {
    $_SESSION['message'] = "Connexion réussie ! Bienvenue administrateur.";
    $_SESSION['type_message'] = "success";
    header("Location: admin.php");
} else {
    $_SESSION['message'] = "Connexion réussie !";
    $_SESSION['type_message'] = "success";
    header("Location: index.php"); // ou home.php
}
exit;