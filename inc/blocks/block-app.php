<?php

/**
 * Block Name: block-app
 *
 * This is the template that displays the 2-colonnes-texte block.
 */
if (have_rows('block_app')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
    $cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
    $ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
    $couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
    $marge_interne_en_haut_du_bloc = get_sub_field('marge_interne_en_haut_du_bloc');
    $marge_interne_en_bas_du_bloc = get_sub_field('marge_interne_en_bas_du_bloc');
    $publication_liste_app = get_sub_field('publication_liste_app_child');
    $type_de_filtre = get_sub_field('type_de_filtre');
    $champ_recherche = get_sub_field('champs_texte_pour_affiner');
    $filtre_etage_1_activation = get_sub_field('filtre_etage_1_activation');
    $filtre_etage_1 = get_sub_field('filtre_etage_1');
    $filtre_etage_2_activation = get_sub_field('filtre_etage_2_activation');
    $filtre_etage_2 = get_sub_field('filtre_etage_2');
    $filtre_etage_3_activation = get_sub_field('filtre_etage_3_activation');
    $filtre_etage_3 = get_sub_field('filtre_etage_3');
    $filtre_etage_4_activation = get_sub_field('filtre_etage_4_activation');
    $filtre_etage_4 = get_sub_field('filtre_etage_4');
    $max_posts = get_sub_field('max_posts');
    $increment_number = get_sub_field('increment_number');
    $texte_fin_candidature = get_sub_field('date_de_fin_de_candidature_texte');
    $texte_bouton_fiche_de_poste = get_sub_field('texte_bouton_fiche_de_poste');
    $texte_en_savoir_plus = get_sub_field('texte_en_savoir_plus');
    $afficher_la_taxonomie_dans_les_extraits_1 = get_sub_field('afficher_la_taxonomie_dans_les_extraits_1');
    if ($afficher_la_taxonomie_dans_les_extraits_1) {
        $afficher_la_taxonomie_dans_les_extraits_1 = $filtre_etage_1;
    }
    $afficher_la_taxonomie_dans_les_extraits_2 = get_sub_field('afficher_la_taxonomie_dans_les_extraits_2');
    if ($afficher_la_taxonomie_dans_les_extraits_2) {
        $afficher_la_taxonomie_dans_les_extraits_2 = $filtre_etage_2;
    }
    $afficher_la_taxonomie_dans_les_extraits_3 = get_sub_field('afficher_la_taxonomie_dans_les_extraits_3');
    if ($afficher_la_taxonomie_dans_les_extraits_3) {
        $afficher_la_taxonomie_dans_les_extraits_3 = $filtre_etage_3;
    }
    $afficher_la_taxonomie_dans_les_extraits_4 = get_sub_field('afficher_la_taxonomie_dans_les_extraits_4');
    if ($afficher_la_taxonomie_dans_les_extraits_4) {
        $afficher_la_taxonomie_dans_les_extraits_4 = $filtre_etage_4;
    }
    $afficher_le_bouton_lie_a_la_fiche_de_poste = get_sub_field('afficher_le_bouton_lie_a_la_fiche_de_poste');
    $afficher_bouton_de_telechargement = get_sub_field('afficher_le_bouton_de_telechargement');
    $texte_bouton_de_telechargement = get_sub_field('texte_du_bouton_de_telechargement');
    $banniere_avec_du_texte_libre = get_sub_field('banniere_avec_du_texte_libre');
    $texte_les_evenements_a_venir = get_sub_field('texte_les_evenements_a_venir');
    $texte_les_evenements_passés = get_sub_field('texte_les_evenements_passés');
    $texte_tous_les_filtres_1 = get_sub_field('texte_tous_les_filtres_1');
    $texte_tous_les_filtres_2 = get_sub_field('texte_tous_les_filtres_2');
    $texte_tous_les_filtres_3 = get_sub_field('texte_tous_les_filtres_3');
    $texte_tous_les_filtres_4 = get_sub_field('texte_tous_les_filtres_4');
    $texte_date_de_levenement = get_sub_field('texte_date_de_levenement');
    $texte_date_de_lappel_a_projet = get_sub_field('texte_date_de_lappel_a_projet');
    $loadMoreText = get_sub_field('load_more_text');
    $faire_passer_le_bloc_au_dessus_des_autres = get_sub_field('faire_passer_le_bloc_au_dessus_des_autres');
    $texte_bouton_video = get_sub_field('texte_bouton_video');
endif;

wp_enqueue_script('vue-app-js', get_stylesheet_directory_uri() . '/vue-app/dist/assets/index.js');
/* wp_enqueue_style('vue-app-css', get_stylesheet_directory_uri() . '/vue-app/dist/assets/index.css');
 */?>
<div id="block-app" class="<?php
                            if ($marge_interne_en_haut_du_bloc) :  echo " padding_section_top";
                            endif;
                            if ($marge_interne_en_bas_du_bloc) :  echo " padding_section_bottom";
                            endif;
                            if ($couleur_de_fond_bloc) :  echo " " . $couleur_de_fond_bloc;
                            endif;
                            if ($cb_ajouter_une_classe_css) :  echo " " . $cb_ajouter_une_classe_css . "";
                            endif;
                            if ($faire_passer_le_bloc_au_dessus_des_autres) :
                                echo " z-index-1";
                            endif;
                            ?>">
    <div class="block">
        <div class="content_width" id="app" <?php
                                            $attribut1 = $afficher_le_bouton_lie_a_la_fiche_de_poste ? 'afficher-bouton-fiche-de-poste="' . $afficher_le_bouton_lie_a_la_fiche_de_poste . '"' : '';
                                            $attribut2 = $afficher_la_taxonomie_dans_les_extraits_4 ? 'taxo-4-extrait="' . $afficher_la_taxonomie_dans_les_extraits_4 . '"' : '';
                                            $attribut3 = $afficher_la_taxonomie_dans_les_extraits_3 ? 'taxo-3-extrait="' . $afficher_la_taxonomie_dans_les_extraits_3 . '"' : '';
                                            $attribut4 = $afficher_la_taxonomie_dans_les_extraits_2 ? 'taxo-2-extrait="' . $afficher_la_taxonomie_dans_les_extraits_2 . '"' : '';
                                            $attribut5 = $afficher_la_taxonomie_dans_les_extraits_1 ? 'taxo-1-extrait="' . $afficher_la_taxonomie_dans_les_extraits_1 . '"' : '';
                                            $attribut6 = $texte_les_evenements_a_venir ? 'texte-evenements-a-venir="' . $texte_les_evenements_a_venir . '"' : '';
                                            $attribut7 = $texte_les_evenements_passés ? 'texte-evenements-passes="' . $texte_les_evenements_passés . '"' : '';
                                            $attribut8 = $texte_tous_les_filtres_1 ? 'texte-tous-les-filtres-1="' . $texte_tous_les_filtres_1 . '"' : '';
                                            $attribut9 = $texte_tous_les_filtres_2 ? 'texte-tous-les-filtres-2="' . $texte_tous_les_filtres_2 . '"' : '';
                                            $attribut10 = $texte_tous_les_filtres_3 ? 'texte-tous-les-filtres-3="' . $texte_tous_les_filtres_3 . '"' : '';
                                            $attribut11 = $texte_tous_les_filtres_4 ? 'texte-tous-les-filtres-4="' . $texte_tous_les_filtres_4 . '"' : '';
                                            $attribut12 = $banniere_avec_du_texte_libre ? 'banniere-avec-du-texte-libre="' . $banniere_avec_du_texte_libre . '"' : '';
                                            $attribut13 = $texte_bouton_de_telechargement ? 'texte-bouton-de-telechargement="' . $texte_bouton_de_telechargement . '"' : '';
                                            $attribut14 = $afficher_bouton_de_telechargement ? 'afficher-bouton-de-telechargement="' . $afficher_bouton_de_telechargement . '"' : '';
                                            $attribut15 = $texte_fin_candidature ? 'texte-fin-candidature="' . $texte_fin_candidature . '"' : '';
                                            $attribut16 = $texte_en_savoir_plus ? 'texte-en-savoir-plus="' . $texte_en_savoir_plus . '"' : '';
                                            $attribut17 = $texte_bouton_fiche_de_poste ? 'texte-bouton-fiche-de-poste="' . $texte_bouton_fiche_de_poste . '"' : '';
                                            $attribut19 = $increment_number ? 'increment-number="' . $increment_number . '"' : '';
                                            $attribut20 = $max_posts ? 'max-posts="' . $max_posts . '"' : '';
                                            $attribut21 = $publication_liste_app ? 'cpt="' . $publication_liste_app . '"' : '';
                                            $attribut22 = $type_de_filtre ? 'filtre="' . $type_de_filtre . '"' : '';
                                            $attribut23 = $champ_recherche ? 'champ-recherche="' . $champ_recherche . '"' : '';
                                            $attribut24 = $filtre_etage_1_activation ? 'filtre-etage-1="' . $filtre_etage_1 . '"' : '';
                                            $attribut25 = $filtre_etage_2_activation ? 'filtre-etage-2="' . $filtre_etage_2 . '"' : '';
                                            $attribut26 = $filtre_etage_3_activation ? 'filtre-etage-3="' . $filtre_etage_3 . '"' : '';
                                            $attribut27 = $filtre_etage_4_activation ? 'filtre-etage-4="' . $filtre_etage_4 . '"' : '';
                                            $attribut28 = $texte_date_de_lappel_a_projet ? 'texte-date-de-lappel-a-projet="' . $texte_date_de_lappel_a_projet . '"' : '';
                                            $attribut29 = $texte_date_de_levenement ? 'texte-date-de-levenement="' . $texte_date_de_levenement . '"' : '';
                                            $attribut30 = $loadMoreText ? 'load-more-text="' . $loadMoreText . '"' : '';
                                            $attribut31 = $texte_bouton_video ? 'texte-bouton-video="' . $texte_bouton_video . '"' : '';
                                            echo $attribut1 . $attribut2 . $attribut3 . $attribut4 . $attribut5 . $attribut6 . $attribut7 . $attribut8 . $attribut9 . $attribut10 . $attribut11 . $attribut12 . $attribut13 . $attribut14 . $attribut15 . $attribut16 . $attribut17 . $attribut19 . $attribut20 . $attribut21 . $attribut22 . $attribut23 . $attribut24 . $attribut25 . $attribut26 . $attribut27 . $attribut28 . $attribut29 . $attribut30 . $attribut31;
                                            ?>></div>
        <?php get_template_part('inc/content-builder-inc/visuel-fond-du-bloc') ?>
    </div>
</div>