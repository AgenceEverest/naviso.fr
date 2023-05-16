<?php

/**
 * Template Name: Page de test
 */

 $theme = wp_get_theme();
 $chemin_dossier = $theme->get_stylesheet_directory() . '/img/icons';
 $fichiers = glob($chemin_dossier . '/*');
 
 print_r($fichiers);