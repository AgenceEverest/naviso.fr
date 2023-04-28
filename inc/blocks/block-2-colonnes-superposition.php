<?php

/**
 * Block Name: block-2-colonnes-superposition
 *
 * This is the template that displays the 2-colonnes-texte block.
 */
if (have_rows('block_2_colonnes_superposition')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
    $cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
    $ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
    $couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
    $marge_en_haut_du_bloc = get_sub_field('marge_en_haut_du_bloc');
    $marge_en_bas_du_bloc = get_sub_field('marge_en_bas_du_bloc');
    $cb_calltoaction = get_sub_field('cb_call-to-action');
    $cb_calltoaction_lien = get_sub_field('cb_call-to-action_lien');
    $cb_calltoaction_url = get_sub_field('cb_call-to-action_url');
    $cb_calltoaction_fichier = get_sub_field('cb_call-to-action_fichier');
    $cb_calltoaction_fichier_size = filesize(get_attached_file($cb_calltoaction_fichier));
    $cb_calltoaction_interne_externe = get_sub_field('lien_interne_ou_externe_');
    $ouvrir_dans_un_nouvel_onglet = get_sub_field('ouvrir_dans_un_nouvel_onglet');
    $alignement_du_bouton = get_sub_field('alignement_du_bouton');
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

    $afficher_le_visuel_naviso = get_sub_field('afficher_le_visuel_naviso');
endif;
?>
<?php echo "<div "; ?>
<?php if ($ajouter_un_id_pour_le_css) : ?>
    <?php echo " id='" . $ajouter_un_id_pour_le_css . "'"; ?>
<?php endif; ?>
<?php echo " class='"; ?>
<?php if ($marge_en_haut_du_bloc) : ?>
    <?php echo " padding_section_top"; ?>
<?php endif; ?>
<?php if ($marge_en_bas_du_bloc) : ?>
    <?php echo " padding_section_bottom"; ?>
<?php endif; ?>
<?php if ($couleur_de_fond_bloc) : ?>
    <?php echo " " . $couleur_de_fond_bloc; ?>
<?php endif; ?>
<?php if ($cb_ajouter_une_classe_css) : ?>
    <?php echo " " . $cb_ajouter_une_classe_css . ""; ?>
<?php endif; ?>
<?php echo " block '>"; ?>

<!-- titre avant les colonnes-->
<?php $titre_avant_les_colonnes = get_sub_field('titre_avant_les_colonnes'); ?>
<?php $largeur_de_la_colonne_titre = get_sub_field('largeur_de_la_colonne_titre'); ?>
<?php $separateur_de_la_colonne_titre = get_sub_field('separateur_de_la_colonne_titre'); ?>
<?php $colonne1 = get_sub_field('colonne_1'); ?>
<?php if ($titre_avant_les_colonnes) : ?>
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
<div class="content_width col_flexible col_flexible_2<?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) :
    echo ' deux-cta-sous-bloc';
endif; ?>">
    <!-- Les 2 colonnes -->
    <?php $proportions_des_colonnes = get_sub_field('proportions_des_colonnes'); ?>
    <div class="col_flexible_wrapper col_flexible_superposition <?php echo $proportions_des_colonnes; ?>">
        <!-- Colonne 1 -->
        <div class="col-gauche">
            <?php if (have_rows('colonne_1_colonne_flexible_clonable')) : ?>
                <?php while (have_rows('colonne_1_colonne_flexible_clonable')) : the_row(); ?>
                    <?php get_template_part('inc/content-builder-inc/col-flexible-block'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if (have_rows('colonne_1_dessous_colonne_flexible_clonable')) : ?>
                <?php while (have_rows('colonne_1_dessous_colonne_flexible_clonable')) : the_row(); ?>
                    <?php get_template_part('inc/content-builder-inc/col-flexible-block'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <!-- Colonne 2 -->
        <div class="col-droite">
            <?php if (have_rows('colonne_2_colonne_flexible_clonable')) : ?>
                <?php while (have_rows('colonne_2_colonne_flexible_clonable')) : the_row(); ?>
                    <?php get_template_part('inc/content-builder-inc/col-flexible-block'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if (have_rows('colonne_2_dessous_colonne_flexible_clonable')) : ?>
                <?php while (have_rows('colonne_2_dessous_colonne_flexible_clonable')) : the_row(); ?>
                    <?php get_template_part('inc/content-builder-inc/col-flexible-block'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php $position_CTA = get_sub_field('position_des_deux_cta_sous_le_bloc') ?>

    <div class="cta-sous-bloc-container <?= $position_CTA ?>">
    <?php if ($afficher_un_premier_bouton_sous_le_bloc) : ?>
            <?php get_template_part('inc/content-builder-inc/cta-sous-bloc-1') ?>
        <?php endif; ?>
        <?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) : ?>
            <?php get_template_part('inc/content-builder-inc/cta-sous-bloc-2') ?>
        <?php endif; ?>
    </div>
</div>
<?php get_template_part('inc/content-builder-inc/visuel-fond-du-bloc') ?>

</div>