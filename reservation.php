<?php
$type = isset($_GET['type']) ? $_GET['type'] : 'standard';
    $offerLabel = '';
    $extraPerPersonPerNight = 0;
    $flatExtra = 0;

switch($type) {
    case 'deluxe':
        $nom = "Suite Deluxe";
        $basePrice = 180;
        break;
    case 'weekend':
        $nom = "Offre Week-end";
        $basePrice = 150;
        break;
    default:
        $nom = "Chambre Standard";
        $basePrice = 80;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-check .option-price { display: none; margin-left: 8px; color: var(--gold, #d6a65f); font-weight: 600; }
        .form-check input[type="checkbox"]:checked + label + .option-price { display: inline-block; }
        .note-server { font-size: .95rem; color: #bbb; }
    </style>
</head>
<body>

<div class="reservation-card">
    <h2>Réserver : <?php echo $nom; ?><?php echo ''; ?></h2>
    <p class="price">Prix de base : <?php echo $basePrice; ?>€ / nuit</p>

    <form action="confirmer_reservation.php" method="post">
        <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nights">Nuits</label>
                <input type="number" class="form-control" id="nights" name="nights" value="1" min="1">
            </div>
            <div class="col-md-6">
                <label for="guests">Personnes</label>
                <input type="number" class="form-control" id="guests" name="guests" value="1" min="1">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <h5>Options disponibles</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="breakfast" name="breakfast">
                    <label class="form-check-label" for="breakfast">Petit-déjeuner</label>
                    <span class="option-price">+13€/personne/nuit</span>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="spa" name="spa">
                    <label class="form-check-label" for="spa">Spa & soins</label>
                    <span class="option-price">+40€/personne/nuit</span>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="romance" name="romance">
                    <label class="form-check-label" for="romance">Pack romantique</label>
                    <span class="option-price">forfait +260€</span>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <p class="small-note">Extras sélectionnés : <em class="note-server">les options cochées seront visibles ici ; le total final sera calculé à la confirmation côté serveur.</em></p>
        </div>

        <div class="mt-2">
            <label class="form-label">Total estimé</label>
            <div id="total" class="form-control"><?php echo $basePrice; ?>€ <small class="note-server">(+ options sélectionnées ; total final calculé au serveur)</small></div>
        </div>

        <div class="reservation-actions">
            <a href="javascript:history.back()" class="btn secondary">Retour</a>
            <button type="submit" class="btn">Confirmer la réservation</button>
        </div>
    </form>
</div>
</body>
</html>