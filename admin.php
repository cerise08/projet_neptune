<?php
session_start();
require_once __DIR__ . '/db/config.php'; // exemple si config.php est dans le dossier db

// Vérification : l'utilisateur est connecté
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: index.php?page=connecter");
    exit;
}
// Vérification : est-ce un admin ?
if ($_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit;
}
//////////////////////////////////////////////////////////
// Gestion du changement de rôle
//////////////////////////////////////////////////////////
if (isset($_GET['changerRole'])) {
    $id = intval($_GET['changerRole']);
    // Récupérer le rôle actuel
    $req = $pdo->prepare("SELECT role FROM utilisateurs WHERE id = ?");
    $req->execute([$id]);
    $user = $req->fetch();
    if ($user) {
        // Inversion du rôle
        $newRole = ($user['role'] === 'admin') ? 'user' : 'admin';

        $update = $pdo->prepare("UPDATE utilisateurs SET role = ? WHERE id = ?");
        $update->execute([$newRole, $id]);

        header("Location: listeutilisateurs.php");
        exit;
    }
}
//////////////////////////////////////////////////////////
// Récupérer la liste des utilisateurs
//////////////////////////////////////////////////////////
$utilisateurs = $pdo->query("SELECT * FROM utilisateurs ORDER BY id ASC")->fetchAll();
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Liste des utilisateurs</title>
    <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

  <div class="container py-5">
      <h1 class="text-center mb-4">Liste des utilisateurs</h1>

      <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($utilisateurs as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <span class="badge bg-<?= ($u['role'] === 'admin') ? 'success' : 'secondary' ?>">
                        <?= $u['role'] ?>
                    </span>
                </td>
                <td>
                    <a href="listeutilisateurs.php?changerRole=<?= $u['id'] ?>" 
                       class="btn btn-primary btn-sm">
                       Changer en <?= ($u['role'] === 'admin') ? 'user' : 'admin' ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <div class="text-center mt-4">
        <a href="admin.php" class="btn btn-secondary">Retour au panneau admin</a>
      </div>
  </div>
  </body>
</html>