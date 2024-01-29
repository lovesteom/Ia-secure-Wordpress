<?php
// Code spécifique à la fonctionnalité du journal d'activité
function afficher_journal_activite() {
    echo '<div class="wrap">';
    echo '<h2>Journal d\'activité de Mon Plugin</h2>';

    // Exemple : Récupérer les données du journal (à adapter selon votre logique de stockage)
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

// Exemple de fonction pour récupérer les logs d'activité (à adapter selon votre logique de stockage)
function obtenir_logs_activite() {
    // Dans cet exemple, retourner un tableau statique. Vous devrez implémenter cette fonction en fonction de votre système de stockage réel.
    return array(
        array('utilisateur' => 'John Doe', 'role' => 'Éditeur', 'date_heure' => '2022-02-01 14:30:00', 'action' => 'Connexion'),
        array('utilisateur' => 'Jane Smith', 'role' => 'Administrateur', 'date_heure' => '2022-02-02 09:45:00', 'action' => 'Modification d\'article'),
        // Ajoutez d'autres entrées en fonction de vos besoins
    );
}
