<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meilleur Hotel</title>
    <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Hotel NEPTUNE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=home">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=chambre">Chambres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=offre">Offres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=resto">Restauration</a>
          </li>
        </ul>

        <div class="d-flex">
          <?php if(isset($_SESSION['user'])): ?>
              <a href="index.php?page=profil" class="btn btn-outline-light me-2">
                  <?= htmlspecialchars($_SESSION['user']['email']); ?>
              </a>
              <a href="deconnecter.php" class="btn btn-danger">Déconnexion</a>
          <?php else: ?>
              <a href="index.php?page=inscription" class="btn btn-reserve me-2">S'inscrire</a>
              <a href="index.php?page=connecter" class="btn btn-reserve me-3">Se connecter</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

<div class="container text-center mt-3">
  <div class="row align-items-start">

<?php
// Affichage des messages flash (succès / erreur)
if(isset($_SESSION['message'])): ?>
<div class="alert alert-<?= $_SESSION['type_message'] ?? 'info' ?> mt-3 w-100">
    <?= htmlspecialchars($_SESSION['message']); ?>
</div>
<?php
unset($_SESSION['message'], $_SESSION['type_message']);
endif;
?>