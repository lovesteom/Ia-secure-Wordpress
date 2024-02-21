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
    }
// Globale : Fonction de redirection de redirection de tous url wp-admin vers la page 404 
// Définir les constantes

define( 'MON_PLUGIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MON_PLUGIN_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Fonction de redirection de redirection de tous url wp-admin vers la page 404 

/* A faire en urgence ; mettre une condition dans la redirection pour 
quand l'utilisateur est connecté, ne plus faire la redirection.
si l'utilisateur n'est pas connecter => rediriger 'wp-admin' vers la page 404 */
function mon_plugin_rediriger_wp_admin() {

  // Vérifier si l'URL contient "wp-admin"
  if ( strpos( $_SERVER['REQUEST_URI'], 'wp-admin' ) !== false ) {

    //vérifie si l'utilisateur n'est pas connecté 
    if ( ! is_user_logged_in() ) {
        // Rediriger vers la page 404
        wp_redirect( home_url( '/404' ) );
        exit;
    }
  }

}

// Ajouter une action pour rediriger les liens "wp-admin"
add_action( 'init', 'mon_plugin_rediriger_wp_admin' );