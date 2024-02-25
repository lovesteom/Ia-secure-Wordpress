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
$slugs_change='om';
$slugs_valide=$slugs_change.'.php';
// Ajouter une action pour rediriger les liens "wp-admin"
add_action( 'init', 'mon_plugin_rediriger_wp_admin' );


//Sur cette partie, faire en sorte que quand le changement est fait une fois de plus le faire ou de faire une vérification de fichier << si wp-login.php existe renomé le ficher
rename("C:/xampp/htdocs/tera/wp-login.php", "C:/xampp/htdocs/tera/$slugs_valide");


$chemin_fichier= "C:/xampp/htdocs/tera/$slugs_valide";
$mot_a_remplacer="wp-login.php";
$nouveau_mot=$slugs_valide;


function remplacer_mot_dans_fichier($chemin_fichier, $mot_a_remplacer, $nouveau_mot) {
  // Ouvrir le fichier en mode lecture
  if (!$handle = fopen($chemin_fichier, 'r')) {
      return 'Impossible d\'ouvrir le fichier';
  }

  // Lire le contenu du fichier
  $contenu_fichier = fread($handle, filesize($chemin_fichier));

  // Fermer le fichier
  fclose($handle);

  // Remplacer chaque occurrence du mot à remplacer par le nouveau mot
  $contenu_fichier_modifie = str_replace($mot_a_remplacer, $nouveau_mot, $contenu_fichier);

  // Ouvrir le fichier en mode écriture
  if (!$handle = fopen($chemin_fichier, 'w')) {
      return 'Impossible d\'ouvrir le fichier';
  }

  // Écrire le contenu modifié dans le fichier
  if (fwrite($handle, $contenu_fichier_modifie) === FALSE) {
      return 'Impossible d\'écrire dans le fichier';
  }

  // Fermer le fichier
  fclose($handle);

  return 'Le remplacement a été effectué avec succès.';
}

// Utilisation de la fonction avec le chemin vers le fichier et les mots à remplacer
$chemin_fichier = 'chemin_vers_votre_fichier.txt';
$mot_a_remplacer = 'ZZZ';
$nouveau_mot = 'AAA';

$resultat = remplacer_mot_dans_fichier($chemin_fichier, $mot_a_remplacer, $nouveau_mot);
echo $resultat;