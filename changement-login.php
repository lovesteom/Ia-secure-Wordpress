<?php

// Ajouter une action pour rediriger les liens "wp-admin"
add_action( 'init', 'mon_plugin_rediriger_wp_admin' );

// Code spécifique à la fonctionnalité de changement d'URL de connexion
function afficher_changement_login() {
    ?>
    <div class="wrap">
        <h2>Changement d'URL de Connexion</h2>

       
<form class="form" id="searchForm" onsubmit="return validateForm()">
    
    <p class="message">Veuillez saisir le slug.  </p>
       
    <label>
        <input required="" placeholder="" type="text" class="input" id="searchText">
        
    </label> 
    
    <button class="submit">Valider</button>
    
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le champ de texte a été soumis et n'est pas vide
    if (isset($_POST["searchText"]) && !empty($_POST["searchText"])) {
        // Récupérer la valeur du champ de texte
        $slugs_change = $_POST["searchText"];
        
        function chargeur();
        
    } else {
        // Si le champ de texte est vide, afficher un message d'erreur
        echo "Veuillez saisir un slug.";
    }
}
?>

<style>
                .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            }

            .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
            }

            .title::before,.title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0px;
            background-color: royalblue;
            }

            .title::before {
            width: 18px;
            height: 18px;
            background-color: royalblue;
            }

            .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
            }

            .message, .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
            }

            .signin {
            text-align: center;
            }

            .signin a {
            color: royalblue;
            }

            .signin a:hover {
            text-decoration: underline royalblue;
            }

            .form label {
            position: relative;
            }

            .form label .input {
            width: 100%;
            padding: 10px 10px 20px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
            }

            .form label .input + span {
            position: absolute;
            left: 10px;
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
            }

            .form label .input:placeholder-shown + span {
            top: 15px;
            font-size: 0.9em;
            }

            .form label .input:focus + span,.form label .input:valid + span {
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
            }

            .form label .input:valid + span {
            color: green;
            }

            .submit {
            border: none;
            outline: none;
            background-color: royalblue !important;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transform: .3s ease;
            }

            .submit:hover {
            background-color: rgb(56, 90, 194);
            }

            @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
            }
</style>
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



//Sur cette partie, faire en sorte que quand le changement est fait une fois de plus le faire ou de faire une vérification de fichier << si wp-login.php existe renomé le ficher
function chargeur()  {  

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
      
      
      $resultat = remplacer_mot_dans_fichier($chemin_fichier, $mot_a_remplacer, $nouveau_mot);
      echo $resultat;
}




