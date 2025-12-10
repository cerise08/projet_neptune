		<div class="registration-card">
    <div class="registration-left" aria-hidden="true"></div>
    <div class="registration-right">
        <div class="mb-2">
            <h2 class="registration-title">Inscription - Hotel NEPTUNE</h2>
            <div class="registration-sub small-note">Rejoignez notre programme et profitez d'avantages exclusifs.</div>
        </div>

        <form action="confirmer_inscription.php" method="post" novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="tel" id="phone" name="phone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" required minlength="6">
                </div>
                <div class="col-md-6">
                    <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="form-control" required>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="newsletter" name="newsletter">
                        <label class="form-check-label" for="newsletter">S'inscrire à la newsletter et offres exclusives</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">J'accepte les <a href="#">conditions générales</a></label>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-reserve">Créer mon compte</button>
                </div>
            </div>
        </form>

        <p class="small-note mt-3">Vous recevrez un email de confirmation après validation.</p>
    </div>
</div>