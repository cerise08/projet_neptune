<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connecter");
    exit;
}
require_once "db/mariadb.php";

$userId = $_SESSION['user']['id'];

// Exemple : récupérer infos user pour affichage
$stmt = $dbh->prepare("SELECT * FROM user WHERE id = :id");
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="profile-card">
    <h2>Profil de <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h2>
    <p>Email : <?= htmlspecialchars($user['email']) ?></p>

    <a href="index.php?page=modifier_profil" class="btn btn-warning">Modifier mon profil</a>
    <a href="supprimer_compte.php" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer votre compte ?')">Supprimer mon compte</a>
</div>