<?php

//COde fonctionnelle mais revoir les bugs dans wordpress 
// Code spécifique à la fonctionnalité du journal d'activité
function afficher_journal_activite() {
    echo '<div class="wrap">';
    echo '<h2>Journal d\'activité de utilisateurs</h2>';

    // Récupérer les logs d'activité
    $logs = obtenir_logs_activite();

    // Afficher le tableau si des logs existent
    if (!empty($logs)) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>Nom de l\'utilisateur</th><th>Rôle</th><th>Date et Heure</th><th>Action effectuée</th></tr></thead>';
        echo '<tbody>';

        foreach ($logs as $log) {
            echo '<tr>';
            echo '<td>' . esc_html($log['utilisateur']) . '</td>';
            echo '<td>' . esc_html($log['role']) . '</td>';
            echo '<td>' . esc_html($log['date_heure']) . '</td>';
            echo '<td>' . esc_html($log['action']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>Aucun journal d\'activité à afficher.</p>';
    }

    echo '</div>';
}

// Fonction pour enregistrer les logs d'activité lors de la connexion
function enregistrer_log_activite($user_login, $user) {
    // Récupérer les données nécessaires
    $utilisateur = $user->user_login;
    $role = reset($user->roles); // Prendre le premier rôle de l'utilisateur
    $date_heure = current_time('mysql');
    $action = 'Connexion';

    // Enregistrer les données dans vos options ou base de données (à adapter selon vos besoins)
    $logs = obtenir_logs_activite();
    $logs[] = array('utilisateur' => $utilisateur, 'role' => $role, 'date_heure' => $date_heure, 'action' => $action);
    update_option('logs_activite_option', $logs);
}

// Action pour enregistrer les logs lors de la connexion
add_action('wp_login', 'enregistrer_log_activite', 10, 2);

// Fonction pour récupérer les logs d'activité
function obtenir_logs_activite() {
    // Récupérer les logs d'activité (à adapter selon votre logique de stockage)
    return get_option('logs_activite_option', array());
}
