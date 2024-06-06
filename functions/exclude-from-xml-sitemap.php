<?php 
// Exclure les contneus inutiles du sitemap XML de Yoast

add_filter( 'wpseo_sitemap_exclude_taxonomy', 'exclude_taxonomy_from_sitemap', 10, 2 );
function exclude_taxonomy_from_sitemap( $value, $taxonomy ) {
    if ( $taxonomy == 'type_de_metier_actualite' ) {
        return true;
    }
    if ( $taxonomy == 'nom_logiciel' ) {
        return true;
    }
    if ( $taxonomy == 'type_de_formation' ) {
        return true;
    }
    if ( $taxonomy == 'type_de_metier' ) {
        return true;
    }
    if ( $taxonomy == 'partenaire' ) {
        return true;
    }
    return $value;
}

// add_filter( 'wpseo_sitemap_exclude_post_type', 'exclude_posttype_from_sitemap', 10, 2 );
// function exclude_posttype_from_sitemap( $value, $taxonomy ) {
//     if ($post_type == 'metier') {
//         return true;
//     }
//     if ($post_type == 'client') {
//         return true;
//     }
//     return $value;
// }

add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'exclude_from_sitemap_by_id', 10, 2 );
function exclude_from_sitemap_by_id($excluded_posts) {
    $excluded_posts[] = 65; // C'est l'ID de la page contact
    //$excluded_posts[] = 124; // Ajoutez autant de lignes que nécessaire pour exclure d'autres pages ou articles par leur ID.

    return $excluded_posts;
}