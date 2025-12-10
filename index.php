<?php
// index.php

// Démarre la session (une seule fois)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupère le message d'alerte si défini
$message = $_SESSION['message'] ?? '';
$type_message = $_SESSION['type_message'] ?? '';
unset($_SESSION['message'], $_SESSION['type_message']);

// Détermine quelle page inclure
$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home', 'chambre', 'offre', 'resto', 'inscription', 'connecter', 'profil'];
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// Inclut le header (navbar + session_start déjà gérée)
include 'header.php';
?>

<!-- Affiche l'alerte si nécessaire -->
<?php if ($message): ?>
    <div class="container mt-3">
        <div class="alert alert-<?= htmlspecialchars($type_message) ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<div class="container text-center mt-4">
    <div class="row align-items-start">
        <?php
        // Inclut la page demandée
        include $page . '.php';
        ?>
    </div>
</div>

<?php
// Inclut le footer si tu en as un
include 'footer.php';
?>