<?php
add_action( 'init', 'mon_plugin_rediriger_wp_admin' );
define( 'MON_PLUGIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MON_PLUGIN_PLUGIN_URL', plugins_url( '/', __FILE__ ) );


// Ajouter une action pour rediriger les liens "wp-admin"
// add_action( 'init', 'mon_plugin_rediriger_wp_admin' );
//$home_path = get_home_path();
//$plugin = $home_path  . 'wp-content/plugins/Ia-secure-Wordpress-debut-ia-wordpress/ia secure wordpress.php';
// Code spécifique à la fonctionnalité de changement d'URL de connexion


function afficher_lien_changement_login() {
    //printf( 'Path: %s', get_home_path() );
    get_home_path();
    // $home_path;
    $paths= get_home_path();
   // echo $paths;
    $plugin = $paths  . 'wp-content/plugins/Ia-secure-Wordpress-debut-ia-wordpress/ia secure wordpress.php';
    echo $plugin;
    ?>
    <div class="formbold-main-wrapper">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
        <div class="formbold-form-wrapper">
        <h2>Changement de Login</h2>
        <h4>Veuillez saisir le lien.  </h4>
        <p>Exemple : login</p>
    <form  method="POST">
      <div class="formbold-email-subscription-form">
             
      <input
          type="txt"
          name="text"
          id="searchText"
          placeholder="Entrer votre lien"
          class="formbold-form-input"
        />

        <button class="formbold-btn">
        Enregistrer
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_1661_1158)">
        <path d="M2.494 0.937761L14.802 7.70709C14.8543 7.73587 14.8978 7.77814 14.9282 7.8295C14.9586 7.88087 14.9746 7.93943 14.9746 7.99909C14.9746 8.05875 14.9586 8.11732 14.9282 8.16868C14.8978 8.22005 14.8543 8.26232 14.802 8.29109L2.494 15.0604C2.44325 15.0883 2.3861 15.1026 2.32818 15.1017C2.27027 15.1008 2.21358 15.0848 2.16372 15.0553C2.11385 15.0258 2.07253 14.9839 2.04382 14.9336C2.01511 14.8833 2.00001 14.8264 2 14.7684V1.22976C2.00001 1.17184 2.01511 1.11492 2.04382 1.06461C2.07253 1.0143 2.11385 0.97234 2.16372 0.942865C2.21358 0.913391 2.27027 0.897419 2.32818 0.896524C2.3861 0.895629 2.44325 0.909842 2.494 0.937761ZM3.33333 8.66576V13.0771L12.5667 7.99909L3.33333 2.92109V7.33243H6.66667V8.66576H3.33333Z" fill="white"/>
        </g>
        <defs>
        <clipPath id="clip0_1661_1158">
        <rect width="16" height="16" fill="white"/>
        </clipPath>
        </defs>
        </svg>
        </button>
      </div>

    </form>
    </div>
    </div>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: "Inter", sans-serif;
  }
  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    padding: 15px;
    border-radius:10px;
    max-width: 550px;
    width: 100%;
    background: white;
  }

  .formbold-form-input {
    width: 100%;
    padding: 13px 22px;
    border-radius: 6px;
    border: 1px solid #DDE3EC;
    background: white;
    font-weight: 500;
    font-size: 16px;
    color: #536387;
    outline: none;
    resize: none;
  }
  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }
  .formbold-email-subscription-form {
    display: flex;
    gap: 15px;
  }

  .formbold-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    border-radius: 5px;
    padding: 13px 25px;
    border: none;
    font-weight: 500;
    background-color: #6A64F1;
    color: white;
    cursor: pointer;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

</style>
  <?php

    if ( ! is_plugin_active( $plugin ) ) {

   
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifier si le champ de texte a été soumis et n'est pas vide
                    if (isset($_POST["searchText"]) && !empty($_POST["searchText"])) {
                    // Récupérer la valeur du champ de texte
                    $slugs_change = $_POST["searchText"];
                    $slugs_valide = $slugs_change;

                    $chemin_fichier= "$paths./.$slugs_valide";
                    $mot_a_remplacer="wp-login.php";
                    $nouveau_mot=$slugs_valide;

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
                
                        echo 'Le remplacement a été effectué avec succès.';

                        $resultat = remplacer_mot_dans_fichier($chemin_fichier, $mot_a_remplacer, $nouveau_mot);
                        echo $resultat;
                     } else {
                    // Si le champ de texte est vide, afficher un message d'erreur
                         echo "Veuillez saisir un slug.";
                     }

                     rename("$paths/wp-login.php", "$paths/$slugs_valide");
    
                      
            }

    }
    
}

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

