<?php

/**
 * Block Name: block-newsletter 
 *
 * This is the template that displays block-more-informations.
 */
if (have_rows('block_newsletter')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
    $cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
    $ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
    $texte_du_bloc = get_sub_field('texte_du_bloc');
    $bloc_flottant = get_sub_field('bloc_flottant');
    $text_call_to_action = get_sub_field('cb_call-to-action');
    $couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
    $texte_du_bouton = get_sub_field('texte_du_bouton');
    $titre_du_bloc = get_sub_field('titre_du_bloc');
    $contenu_de_liframe = get_sub_field('contenu_de_liframe');
endif;

$urlContact = get_field('url_du_bouton_contact', 'option');
?>
<?php echo "<div "; ?>
<?php if ($ajouter_un_id_pour_le_css) : ?>
    <?php echo " id='" . $ajouter_un_id_pour_le_css . "'"; ?>
<?php endif; ?>
<?php echo " class='"; ?>
<?php if ($cb_ajouter_une_classe_css) : ?>
    <?php echo " " . $cb_ajouter_une_classe_css . ""; ?>
<?php endif; ?>
<?php if ($bloc_flottant) : ?>
    <?php echo " bloc_flottant "; ?>
<?php endif; ?>
<?php if ($couleur_de_fond_bloc) : ?>
    <?php echo " " . $couleur_de_fond_bloc; ?>
<?php endif; ?>
<?php echo " newsletter-container'>"; ?>
<?php get_template_part('inc/dessin-en-fond'); ?>

<!-- colonnes -->
<div class="content_width newsletter-wrapper">
    <?php $largeur_de_la_colonne_contenu = get_sub_field('largeur_de_la_colonne_contenu'); ?>
    <h2><?= $titre_du_bloc ?></h2>
    <!-- Les 2 colonnes -->
    <div class="content-newsletter-block">
        <div class="text_block">
            <?= $texte_du_bloc ?>
        </div>
        <!-- Lien page contact pré-remplie -->
        <p id="bouton-newsletter" class="cta_btn_lead cta_secondaire">
            <a><?= $texte_du_bouton ?></a>
        </p>
    </div>
    <?= showSvg(get_stylesheet_directory_uri() . '/svg/visuel-newsletter.svg') ?>

</div>
</div>

<div class="newsletter-container-feed" id="newsletter" style="display: none">
    <div class=" newsletter-wrapper-feed">
        <?= $contenu_de_liframe ?>
    </div>
</div>