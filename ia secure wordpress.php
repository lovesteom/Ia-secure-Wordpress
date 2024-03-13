
<?php
/*
Plugin Name: IA Secure Wordpress
Description: Un plugin pour la surveillance et la sécurité avancée.
Version: 1.0
Author: LovesteOm
*/



// Charger TensorFlow
//require_once '/chemin/vers/votre/tensorflow/autoload.php';

// Inclure les fichiers des fonctionnalités
include_once plugin_dir_path(__FILE__) . 'journal-activite.php';
include_once plugin_dir_path(__FILE__) . 'configuration.php';
include_once plugin_dir_path(__FILE__) . 'changement-login.php';

// Ajouter des actions pour initialiser les fonctionnalités
add_action('admin_menu', 'ajouter_page_admin_mon_plugin');

function ajouter_page_admin_mon_plugin() {
    add_menu_page(
        'IA Secure',
        'IA Secure',
        'manage_options',
        'mon-plugin-admin',
        'afficher_journal_activite'
    );

    add_submenu_page(
        'mon-plugin-admin',
        'Configuration',
        'Configuration',
        'manage_options',
        'mon-plugin-config',
        'afficher_page_configuration'
    );

    add_submenu_page(
        'mon-plugin-admin',
        'Changement de Login',
        'Changement de Login',
        'manage_options',
        'mon-plugin-changement-login',
        'afficher_lien_changement_login'
    );
}

//-----------------$$$$$$$$$$$$-----------




function afficher_page_admin_mon_plugin() {
?>
    <div class="wrap">
        <h2>Configuration de Mon Plugin</h2>
        <form method="post" action="options.php">
            <?php
                settings_fields('mon_plugin_options');
                do_settings_sections('mon_plugin_options');
                submit_button();
            ?>
        </form>
    </div>
    <?php 
    // Exemple : Afficher une page avec les journaux d'activité
    echo '<div class="wrap">';
    echo '<h2>Journal d\'activité </h2>';
    
    // Vous pouvez personnaliser cette partie pour afficher les journaux ou les paramètres de votre plugin
    // Exemple : Lire et afficher le contenu du fichier de journal
    $log_content = file_get_contents(dirname(__FILE__) . '/connexion_logs.txt');
    echo '<pre>' . esc_html($log_content) . '</pre>';

    echo '</div>';
}



function afficher_section() {
    echo '<p>Une description de la section.</p>';
}
