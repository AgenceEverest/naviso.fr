<?php

/**
 * Block Name: block-1-colonne    
 *
 * This is the template that displays the 2-colonnes-texte block.
 */
if (have_rows('block_1_colonne')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
    $cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
    $ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
    $couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
    $marge_en_haut_du_bloc = get_sub_field('marge_en_haut_du_bloc');
    $marge_en_bas_du_bloc = get_sub_field('marge_en_bas_du_bloc');
    $ouvrir_dans_un_nouvel_onglet = get_sub_field('ouvrir_dans_un_nouvel_onglet');
    $cb_calltoaction_interne_externe = get_sub_field('lien_interne_ou_externe_');
    $cb_calltoaction_lien = get_sub_field('cb_call-to-action_lien');
    $alignement_du_bouton = get_sub_field('alignement_du_bouton');
    $cb_calltoaction = get_sub_field('cb_call-to-action');
    $cb_calltoaction_url = get_sub_field('cb_call-to-action_url');
    $cb_calltoaction_fichier = get_sub_field('cb_call-to-action_fichier');
    $cb_calltoaction_fichier_size = filesize(get_attached_file($cb_calltoaction_fichier));
    $style_du_bouton = get_sub_field('style_du_bouton');

    $afficher_un_premier_bouton_sous_le_bloc = get_sub_field('afficher_un_premier_bouton_sous_le_bloc');
    $afficher_un_deuxieme_bouton_sous_le_bloc = get_sub_field('afficher_un_deuxieme_bouton_sous_le_bloc');
    $cb_calltoaction_lien_2 = get_sub_field('cb_call-to-action_lien_2');
    $cb_calltoaction_interne_externe_2 = get_sub_field('lien_interne_ou_externe_2');
    $ouvrir_dans_un_nouvel_onglet_2 = get_sub_field('ouvrir_dans_un_nouvel_onglet_2');
    $cb_calltoaction_2 = get_sub_field('cb_call-to-action_2');
    $cb_calltoaction_url_2 = get_sub_field('cb_call-to-action_url_2');
    $cb_calltoaction_fichier_2 = get_sub_field('cb_call-to-action_fichier_2');
    $style_du_bouton_2 = get_sub_field('style_du_bouton_2');

endif;
echo "<div ";
if ($ajouter_un_id_pour_le_css) :
    echo " id='" . $ajouter_un_id_pour_le_css . "'";
endif;
echo " class='";
if ($marge_en_haut_du_bloc) :
    echo " padding_section_top";
endif;
if ($marge_en_bas_du_bloc) :
    echo " padding_section_bottom";
endif;
if ($couleur_de_fond_bloc) :
    echo " " . $couleur_de_fond_bloc;
endif;
if ($cb_ajouter_une_classe_css) :
    echo " " . $cb_ajouter_une_classe_css . "";
endif;
echo "'>";

//titre avant les colonnes
$titre_avant_les_colonnes = get_sub_field('titre_avant_les_colonnes');
$largeur_de_la_colonne_titre = get_sub_field('largeur_de_la_colonne_titre');
$separateur_de_la_colonne_titre = get_sub_field('separateur_de_la_colonne_titre');
$colonne1 = get_sub_field('colonne_1');
if ($titre_avant_les_colonnes) : ?>
    <div class="content_width zone_texte_avant_colonnes<?php if (!$colonne1 and $separateur_de_la_colonne_titre == 'pas_de_separateur_titre') : ?> zone_texte_avant_colonnes_nopadding<?php endif; ?>">
        <div class="<?php echo $largeur_de_la_colonne_titre; ?> entry-content">
            <?php echo $titre_avant_les_colonnes; ?>
        </div>
    </div>

    <?php if ($separateur_de_la_colonne_titre != 'pas_de_separateur_titre') : ?>
        <div class="content_width separateur_de_la_colonne_titre_wrapper_wrapper<?php if ($colonne1) : ?> separateur_de_la_colonne_titre_space<?php endif; ?>">
            <div class="separateur_de_la_colonne_titre_wrapper">
                <div class="separateur_de_la_colonne_titre <?php echo $separateur_de_la_colonne_titre; ?>"></div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- colonnes -->
<div class="content_width col_flexible col_flexible_1
<?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) :
    echo ' deux-cta-sous-bloc';
endif; ?>
">
    <?php $largeur_de_la_colonne_contenu = get_sub_field('largeur_de_la_colonne_contenu'); ?>
    <!-- Les 2 colonnes -->
    <div class="col_flexible_wrapper <?php echo $largeur_de_la_colonne_contenu; ?>">
        <!-- Colonne 1 -->
        <?php if (have_rows('colonne_1_colonne_flexible_clonable')) :
            while (have_rows('colonne_1_colonne_flexible_clonable')) : the_row();
                get_template_part('inc/content-builder-inc/col-flexible-block');
            endwhile;
        endif; ?>
    </div>
    <div class="cta-sous-bloc-container">
        <?php if ($afficher_un_premier_bouton_sous_le_bloc) : ?>
            <!-- Lien page contact pré-remplie -->
            <?php if ($cb_calltoaction_interne_externe == 'page_contact') :
                get_template_part('inc/content-builder-inc/cb-form-to-prefilled-form');
            endif; ?>

            <!-- Lien interne  -->
            <?php if ($cb_calltoaction_interne_externe == 'lien_interne') : ?>
                <?php if ($cb_calltoaction_lien) : ?>
                    <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?><?php if (!$colonne1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_lien; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Lien externe  -->
            <?php if ($cb_calltoaction_interne_externe == 'lien_externe') : ?>
                <?php if ($cb_calltoaction_url) : ?>
                    <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?><?php if (!$colonne1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_url; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Fichier à télécharger  -->
            <?php if ($cb_calltoaction_interne_externe == 'fichier_telechargement') : ?>
                <?php if ($cb_calltoaction_fichier) : ?>
                    <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?><?php if ((!$colonne1) && ($separateur_de_la_colonne_titre = 'pas_de_separateur_titre')) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo wp_get_attachment_url($cb_calltoaction_fichier); ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path>
                            </svg><?php echo $cb_calltoaction; ?> <span class="download_doc_size">- <?php echo size_format($cb_calltoaction_fichier_size, $decimals = 0); ?></span></a></p>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) : ?>
            <!-- Lien page contact pré-remplie -->
            <?php if ($cb_calltoaction_interne_externe_2 == 'page_contact') :
                get_template_part('inc/content-builder-inc/cb-form-to-prefilled-form');
            endif; ?>

            <!-- Lien interne  -->
            <?php if ($cb_calltoaction_interne_externe_2 == 'lien_interne') : ?>
                <?php if ($cb_calltoaction_lien_2) : ?>
                    <p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton_2; ?><?php if (!$colonne1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_lien_2; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet_2) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction_2; ?></a></p>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Lien externe  -->
            <?php if ($cb_calltoaction_interne_externe_2 == 'lien_externe') : ?>
                <?php if ($cb_calltoaction_url_2) : ?>
                    <p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton_2; ?><?php if (!$colonne1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_url_2; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet_2) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction_2; ?></a></p>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Fichier à télécharger  -->
            <?php if ($cb_calltoaction_interne_externe_2 == 'fichier_telechargement') : ?>
                <?php if ($cb_calltoaction_fichier_2) : ?>
                    <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $style_du_bouton_2; ?><?php if ((!$colonne1) && ($separateur_de_la_colonne_titre = 'pas_de_separateur_titre')) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo wp_get_attachment_url($cb_calltoaction_fichier_2); ?>" <?php if ($ouvrir_dans_un_nouvel_onglet_2) : ?> target="_blank" <?php endif; ?>><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path>
                            </svg><?php echo $cb_calltoaction_2; ?> <span class="download_doc_size">- <?php echo size_format($cb_calltoaction_fichier_size_2, $decimals = 0); ?></span></a></p>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
</div>