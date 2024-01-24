
<?php
/*
Plugin Name: IA Secure Wordpress
Description: Un plugin pour la surveillance et la sécurité avancée.
Version: 1.0
Author: LovesteOm
*/

// Hook pour la connexion d'un utilisateur
add_action('wp_login', 'surveillance_connexion_utilisateur', 10, 2);

function surveillance_connexion_utilisateur($user_login, $user) {
    // Récupérer l'adresse IP de l'utilisateur
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Exemple : Enregistrez les informations de connexion dans un fichier de journal
    $log_message = "L'utilisateur $user_login s'est connecté depuis l'adresse IP $user_ip le " . date('Y-m-d H:i:s') . "\n";
    
    // Vous pouvez enregistrer cela dans un fichier, une base de données, ou envoyer une notification, selon vos besoins.
    file_put_contents(dirname(__FILE__) . '/connexion_logs.txt', $log_message, FILE_APPEND);

    // Ajoutez ici votre logique pour la détection d'anomalies, la prévention des fraudes, etc.
    // ...

    // Exemple : Blocage d'une adresse IP si une condition est remplie (à adapter selon vos besoins)
    if (condition_a_detecter()) {
        // Bloquer l'adresse IP
        add_action('init', 'bloquer_adresse_ip');
    }
}

function bloquer_adresse_ip() {
    // Exemple : Bloquer l'adresse IP en ajoutant une règle dans le fichier .htaccess
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $htaccess_content = "deny from $user_ip\n";
    file_put_contents(ABSPATH . '.htaccess', $htaccess_content, FILE_APPEND);
}


// Hook pour ajouter une page au menu d'administration
add_action('admin_menu', 'ajouter_page_admin_mon_plugin');

function ajouter_page_admin_mon_plugin() {
    add_menu_page(
        'Mon Plugin',
        'Mon Plugin',
        'manage_options',
        'mon-plugin-admin',
        'afficher_page_admin_mon_plugin'
    );
}

function afficher_page_admin_mon_plugin() {
    // Exemple : Afficher une page avec les journaux d'activité
    echo '<div class="wrap">';
    echo '<h2>Journal d\'activité de Mon Plugin</h2>';
    
    // Vous pouvez personnaliser cette partie pour afficher les journaux ou les paramètres de votre plugin
    // Exemple : Lire et afficher le contenu du fichier de journal
    $log_content = file_get_contents(dirname(__FILE__) . '/connexion_logs.txt');
    echo '<pre>' . esc_html($log_content) . '</pre>';

    echo '</div>';
}
