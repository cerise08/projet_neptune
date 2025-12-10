<?php
// Inclure la connexion à la base
require_once "db/mariadb.php";

// Initialiser le message
$message = '';
$success = false;

// Vérifier que la connexion fonctionne
if (!$dbh) {
    $message = "Erreur de connexion à la base de données.";
} else {
    // Récupérer les données du formulaire
    $nom        = trim($_POST['nom'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $nights     = trim($_POST['nights'] ?? '1');
    $personnes  = trim($_POST['guests'] ?? '1');
    $date_debut = trim($_POST['date_debut'] ?? '');
    $date_fin   = trim($_POST['date_fin'] ?? '');
    $type       = trim($_POST['type'] ?? 'standard');

    // Options
    $options_arr = [];
    if (isset($_POST['breakfast'])) $options_arr[] = 'petitdej';
    if (isset($_POST['spa'])) $options_arr[] = 'spa';
    if (isset($_POST['romance'])) $options_arr[] = 'romance';
    $options_str = implode(',', $options_arr);

    // Vérification simple
    $errors = [];
    if ($nom === '') $errors[] = "Le nom est requis.";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
    if ($date_debut === '' || $date_fin === '') $errors[] = "Les dates sont obligatoires.";

    try {
        $dtStart = new DateTime($date_debut);
        $dtEnd   = new DateTime($date_fin);
        if ($dtEnd <= $dtStart) $errors[] = "La date de départ doit être après la date d'arrivée.";
    } catch (Exception $e) {
        $errors[] = "Format de date invalide.";
    }

    if (empty($errors)) {
        $date_debut_mysql = $dtStart->format('Y-m-d H:i:s');
        $date_fin_mysql   = $dtEnd->format('Y-m-d H:i:s');

        // Vérifier si une réservation existe déjà
        $sqlCheck = "SELECT COUNT(*) AS cnt FROM reservation 
                     WHERE type = :type 
                       AND date_debut <= :date_fin 
                       AND date_fin >= :date_debut";

        $stmt = $dbh->prepare($sqlCheck);
        $stmt->execute([
            ':type'       => $type,
            ':date_debut' => $date_debut_mysql,
            ':date_fin'   => $date_fin_mysql
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['cnt'] > 0) {
            $message = "❌ Cette chambre est déjà réservée à ces dates.";
        } else {
            // Insérer la réservation
            $sqlInsert = "INSERT INTO reservation 
                          (nom, email, nuits, personnes, options, date_debut, date_fin, type)
                          VALUES (:nom, :email, :nuits, :personnes, :options, :date_debut, :date_fin, :type)";
            $stmt = $dbh->prepare($sqlInsert);
            $ok = $stmt->execute([
                ':nom'        => $nom,
                ':email'      => $email,
                ':nuits'      => $nights,
                ':personnes'  => $personnes,
                ':options'    => $options_str,
                ':date_debut' => $date_debut_mysql,
                ':date_fin'   => $date_fin_mysql,
                ':type'       => $type
            ]);

            if ($ok) {
                $success = true;
                $message = "✅ Réservation confirmée ! Merci $nom.<br>
                            <strong>Type :</strong> $type<br>
                            <strong>Du :</strong> $date_debut_mysql <strong>Au :</strong> $date_fin_mysql";
            } else {
                $message = "❌ Erreur lors de l'enregistrement de la réservation.";
            }
        }
    } else {
        $message = "<ul>";
        foreach ($errors as $err) $message .= "<li>" . htmlspecialchars($err) . "</li>";
        $message .= "</ul>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation Réservation</title>
    <link rel="stylesheet" href="style.css"> <!-- ton CSS habituel -->
</head>
<body>
    <?php if (file_exists("header.php")) include "header.php"; ?>

    <div class="reservation-confirmation">
        <div class="<?= $success ? 'success-message' : 'error-message' ?>">
            <?php echo $message; ?>
        </div>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </div>

    <?php if (file_exists("footer.php")) include "footer.php"; ?>
</body>
</html>