<?php
// Code spécifique à la fonctionnalité de changement d'URL de connexion
function afficher_lien_changement_login() {
    echo '<div class="wrap">';
    echo '<h2>Changement d\'URL de Connexion</h2>';
    // Votre logique pour afficher le lien ici
    echo '</div>';
}



// Code spécifique à la fonctionnalité de changement d'URL de connexion
function afficher_changement_login() {
    ?>
    <div class="wrap">
        <h2>Changement d'URL de Connexion</h2>

        <form method="post" action="">
            <label for="nouvelle_url_login">Nouvelle URL de Connexion :</label>
            <input type="text" name="nouvelle_url_login" id="nouvelle_url_login" required />
            <input type="submit" name="submit_nouvelle_url" class="button-primary" value="Enregistrer" />
        </form>

        <?php
        // Traiter la soumission du formulaire
        if (isset($_POST['submit_nouvelle_url'])) {
            // Récupérer la nouvelle URL saisie
            $nouvelle_url_login = esc_url_raw($_POST['nouvelle_url_login']);

            // Valider et enregistrer la nouvelle URL (à adapter selon vos besoins)
            if (filter_var($nouvelle_url_login, FILTER_VALIDATE_URL)) {
                // Enregistrez la nouvelle URL dans vos options ou base de données
                update_option('nouvelle_url_login_option', $nouvelle_url_login);
                echo '<div class="updated"><p>Nouvelle URL de connexion enregistrée avec succès.</p></div>';
            } else {
                echo '<div class="error"><p>URL invalide. Veuillez saisir une URL valide.</p></div>';
            }
        }
        ?>
    </div>
    <?php
}
//-------------$$$$$$-----

