<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="registration-card">
    <div class="registration-left" aria-hidden="true"></div>
    <div class="registration-right">
        <div class="mb-2">
            <h2 class="registration-title">Connexion - Hotel NEPTUNE</h2>
            <div class="registration-sub small-note">Connectez-vous pour gérer vos réservations et profiter d'avantages.</div>
        </div>

        <!-- Affichage du message flash si présent -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['type_message'] ?? 'info' ?>">
                <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['type_message']); ?>
        <?php endif; ?>

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
                <div class="col-12 d-flex justify-content-between align-items-center mt-2">
                    <a href="index.php?page=inscription" class="small-note">Pas encore de compte ? Inscrivez-vous</a>
                    <button type="submit" class="btn btn-reserve">Se connecter</button>
                </div>
            </div>
        </form>
    </div>
</div>