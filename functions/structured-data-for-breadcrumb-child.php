<?php
function generate_breadcrumb_structured_data_child() {  // pour les posts expertises et realisations
    // Récupère le texte du fil d'ariane depuis les champs ACF
    $fil_ariane_accueil = get_field('fil_ariane_accueil', 'option');
    
    // Vérifie si la page est une page simple et n'a pas de parent, et si ce n'est pas la page d'accueil
    if (is_singular('client')) {
        // Ajoutez ici la logique pour les single client
        $page_qui_liste_les_clients = get_field('page_qui_liste_les_clients', 'option');
        $page_qui_liste_les_clients_id = $page_qui_liste_les_clients->ID;
        $page_qui_liste_les_clients_permalink = get_permalink($page_qui_liste_les_clients_id);
        $breadcrumb_data = array(
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => array(
                array(
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => $fil_ariane_accueil, // Nom de la page d'accueil
                    "item" => home_url() // URL de la page d'accueil
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 2,
                    "name" => get_the_title($page_qui_liste_les_clients_id), // Nom de la page qui liste les offres
                    "item" => $page_qui_liste_les_clients_permalink // URL de la page qui liste les offres
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 3,
                    "name" => get_the_title(), // Nom de la page actuelle
                    "item" => get_permalink() // URL de la page actuelle
                )
            )
        );
    } elseif (is_singular('formation')) {
        // Ajoutez ici la logique pour les single formation
        $page_qui_liste_les_formations = get_field('page_qui_liste_les_formations', 'option');
        $page_qui_liste_les_formations_id = $page_qui_liste_les_formations->ID;
        $page_qui_liste_les_formations_permalink = get_permalink($page_qui_liste_les_formations_id);
        $breadcrumb_data = array(
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => array(
                array(
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => $fil_ariane_accueil, // Nom de la page d'accueil
                    "item" => home_url() // URL de la page d'accueil
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 2,
                    "name" => get_the_title($page_qui_liste_les_formations_id), // Nom de la page qui liste les offres
                    "item" => $page_qui_liste_les_formations_permalink // URL de la page qui liste les offres
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 3,
                    "name" => get_the_title(), // Nom de la page actuelle
                    "item" => get_permalink() // URL de la page actuelle
                )
            )
        );
    } elseif (is_singular('logiciel')) {
        // Ajoutez ici la logique pour les single logiciel
        $page_qui_liste_les_logiciels = get_field('page_qui_liste_les_logiciels', 'option');
        $page_qui_liste_les_logiciels_id = $page_qui_liste_les_logiciels->ID;
        $page_qui_liste_les_logiciels_permalink = get_permalink($page_qui_liste_les_logiciels_id);
        $breadcrumb_data = array(
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => array(
                array(
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => $fil_ariane_accueil, // Nom de la page d'accueil
                    "item" => home_url() // URL de la page d'accueil
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 2,
                    "name" => get_the_title($page_qui_liste_les_logiciels_id), // Nom de la page qui liste les offres
                    "item" => $page_qui_liste_les_logiciels_permalink // URL de la page qui liste les offres
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 3,
                    "name" => get_the_title(), // Nom de la page actuelle
                    "item" => get_permalink() // URL de la page actuelle
                )
            )
        );
    } elseif (is_singular('metier')) {
        // Ajoutez ici la logique pour les single logiciel
        $page_qui_liste_les_metiers = get_field('page_qui_liste_les_metiers', 'option');
        $page_qui_liste_les_metiers_id = $page_qui_liste_les_metiers->ID;
        $page_qui_liste_les_metiers_permalink = get_permalink($page_qui_liste_les_metiers_id);
        $breadcrumb_data = array(
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => array(
                array(
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => $fil_ariane_accueil, // Nom de la page d'accueil
                    "item" => home_url() // URL de la page d'accueil
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 2,
                    "name" => get_the_title($page_qui_liste_les_metiers_id), // Nom de la page qui liste les offres
                    "item" => $page_qui_liste_les_metiers_permalink // URL de la page qui liste les offres
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 3,
                    "name" => get_the_title(), // Nom de la page actuelle
                    "item" => get_permalink() // URL de la page actuelle
                )
            )
        );
    }
    if (isset($breadcrumb_data)) {
        // Convertit les données en format JSON
        $json_data = json_encode($breadcrumb_data);
        // Affiche le script JSON-LD dans le <head> de la page
        echo '<script type="application/ld+json">' . $json_data . '</script>';
    }
}

// Ajoute la fonction à l'événement 'wp_head' pour l'afficher dans le <head> du thème
add_action('wp_head', 'generate_breadcrumb_structured_data_child');