<?php
session_start();

// Exemple après vérification du login :
if ($user && password_verify($password, $user['motdepasse'])) {

    // Stocker les infos en session
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['role'];

    // Redirection selon le rôle
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
        exit;
    } else {
        header("Location: home.php");
        exit;
    }
}
?>

<div class="registration-card">
  <div class="registration-left" aria-hidden="true"></div>
  <div class="registration-right">
    <div class="mb-2">
      <h2 class="registration-title">Connexion - Hotel NEPTUNE</h2>
      <div class="registration-sub small-note">Connectez-vous pour gérer vos réservations et profiter d'avantages.</div>
    </div>

    <form action="confirmer_connexion.php" method="post" novalidate>
      <div class="row g-3">
        <div class="col-12">
          <label for="email" class="form-label">Adresse email</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="col-12">
          <label for="password" class="form-label">Mot de passe</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
            <label class="form-check-label" for="remember">Se souvenir de moi</label>
          </div>
        </div>

        <div class="col-12 d-flex justify-content-between align-items-center mt-2">
          <a href="index.php?page=inscription" class="small-note">Pas encore de compte ? Inscrivez-vous</a>
          <button type="submit" class="btn btn-reserve">Se connecter</button>
        </div>
      </div>
    </form>

  </div>
</div>
