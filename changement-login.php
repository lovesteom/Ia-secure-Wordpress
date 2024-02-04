<?php
// Code spécifique à la fonctionnalité de changement d'URL de connexion
function afficher_changement_login() {
    ?>
    <div class="wrap">
        <h2>Changement d'URL de Connexion</h2>

        <form method="post" action="">
            <?php wp_nonce_field('changement_login', 'changement_login_nonce'); ?>
            <label for="nouvelle_url_login">Nouvelle URL de Connexion :</label>
            <input type="text" name="nouvelle_url_login" id="nouvelle_url_login" required />
            <input type="submit" name="submit_nouvelle_url" class="button-primary" value="Enregistrer" />
        </form>

        <?php
        // Traiter la soumission du formulaire
        if (isset($_POST['submit_nouvelle_url'])) {
            // Vérifier la nonce
            if (isset($_POST['changement_login_nonce']) && wp_verify_nonce($_POST['changement_login_nonce'], 'changement_login')) {
                // Récupérer la nouvelle URL saisie
                $nouvelle_url_login = esc_url_raw($_POST['nouvelle_url_login']);

                // Valider et enregistrer la nouvelle URL (à adapter selon vos besoins)
                if (filter_var($nouvelle_url_login, FILTER_VALIDATE_URL)) {
                    // Enregistrez la nouvelle URL dans vos options ou base de données
                    update_option('nouvelle_url_login_option', $nouvelle_url_login);

                    // Enregistrez l'historique du changement
                    enregistrer_historique_changement($nouvelle_url_login);
        // Dans la fonction afficher_changement_login après la mise à jour de l'option
        if (filter_var($nouvelle_url_login, FILTER_VALIDATE_URL)) {
            // Enregistrez la nouvelle URL dans vos options ou base de données
            update_option('nouvelle_url_login_option', $nouvelle_url_login);

            // Supprimer les filtres si l'utilisateur revient à l'URL par défaut
            if (empty($nouvelle_url_login)) {
                remove_filter('login_url', 'filtrer_url_connexion', 10);
                remove_filter('admin_url', 'filtrer_url_admin', 10);
            }

            // Enregistrez l'historique du changement
            enregistrer_historique_changement($nouvelle_url_login);

            echo '<div class="updated"><p>Nouvelle URL de connexion enregistrée avec succès.</p></div>';
        } else {
            echo '<div class="error"><p>URL invalide. Veuillez saisir une URL valide.</p></div>';
        }

                    echo '<div class="updated"><p>Nouvelle URL de connexion enregistrée avec succès.</p></div>';
                } else {
                    echo '<div class="error"><p>URL invalide. Veuillez saisir une URL valide.</p></div>';
                }
            } else {
                // Nonce non valide, traitement d'une tentative d'exploitation
                wp_die('Erreur de sécurité. Veuillez réessayer.');
            }
        }

     

        // Afficher l'historique des changements
        afficher_historique_changements();
        ?>
    </div>
    <?php


}


// Ajoutez ceci dans votre fichier principal (mon-plugin.php ou autre)
add_filter('login_url', 'filtrer_url_connexion', 10, 2);
add_filter('admin_url', 'filtrer_url_admin', 10, 2);

function filtrer_url_connexion($login_url, $redirect) {
    $nouvelle_url_login = get_option('nouvelle_url_login_option', ''); // Récupérer la nouvelle URL
    if (!empty($nouvelle_url_login)) {
        $login_url = esc_url_raw($nouvelle_url_login);
    }
    return $login_url;
}

function filtrer_url_admin($url, $path) {
    $nouvelle_url_login = get_option('nouvelle_url_login_option', ''); // Récupérer la nouvelle URL
    if (!empty($nouvelle_url_login)) {
        $parsed_home_url = parse_url(home_url());
        $url = $parsed_home_url['scheme'] . '://' . $parsed_home_url['host'] . $path;
        $url = str_replace(home_url(), esc_url_raw($nouvelle_url_login), $url);
    }
    return $url;
}



// Fonction pour enregistrer l'historique du changement d'URL
function enregistrer_historique_changement($nouvelle_url) {
    $historique_changements = get_option('historique_changements_option', array());
    $historique_changements[] = array(
        'url' => $nouvelle_url,
        'date' => current_time('mysql'),
        'utilisateur' => get_current_user_id(),
    );
    update_option('historique_changements_option', $historique_changements);
}

// Fonction pour afficher l'historique des changements
function afficher_historique_changements() {
    $historique_changements = get_option('historique_changements_option', array());

    if (!empty($historique_changements)) {
        echo '<h3>Historique des Changements d\'URL</h3>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>URL</th><th>Date</th><th>Changé par Utilisateur</th></tr></thead>';
        echo '<tbody>';

        foreach ($historique_changements as $changement) {
            echo '<tr>';
            echo '<td>' . esc_html($changement['url']) . '</td>';
            echo '<td>' . esc_html($changement['date']) . '</td>';
            echo '<td>' . esc_html($changement['utilisateur']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    }
}
