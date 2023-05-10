<?php

/**
 * Block Name: block-selection-clients 
 *
 * This is the template that displays the 2-colonnes-texte block.
 */
if (have_rows('block_selection_clients')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
    $cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
    $ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
    $couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
    $marge_externe_en_haut_du_bloc = get_sub_field('marge_externe_en_haut_du_bloc');
    $marge_externe_en_bas_du_bloc = get_sub_field('marge_externe_en_bas_du_bloc');
    $marge_interne_en_haut_du_bloc = get_sub_field('marge_interne_en_haut_du_bloc');
    $marge_interne_en_bas_du_bloc = get_sub_field('marge_interne_en_bas_du_bloc');

    $liste_des_clients_a_afficher = get_sub_field('liste_des_clients_a_afficher');
    $cta_url_video = get_sub_field('cta_url_video');
    $cta_texte_video_cas_client = get_sub_field('cta_texte_video_cas_client');
    $cta_cas_client_en_savoir_plus = get_sub_field('cta_cas_client_en_savoir_plus');
endif;

?>

<?php echo "<div "; ?>
<?php if ($ajouter_un_id_pour_le_css) : ?>
    <?php echo " id='" . $ajouter_un_id_pour_le_css . "'"; ?>
<?php endif; ?>
<?php echo " class='"; ?>
<?php if ($marge_interne_en_haut_du_bloc) :
    echo " padding_section_top";
endif;
if ($marge_interne_en_bas_du_bloc) :
    echo " padding_section_bottom";
endif;
if ($marge_externe_en_haut_du_bloc) :
    echo " margin_section_top";
endif;
if ($marge_externe_en_bas_du_bloc) :
    echo " margin_section_bottom";
endif; ?>
<?php if ($couleur_de_fond_bloc) : ?>
    <?php echo " " . $couleur_de_fond_bloc; ?>
<?php endif; ?>
<?php if ($cb_ajouter_une_classe_css) : ?>
    <?php echo " " . $cb_ajouter_une_classe_css . ""; ?>
<?php endif; ?>
<?php echo " block '>" ?>

<!-- titre avant les colonnes-->
<?php $titre_avant_les_colonnes = get_sub_field('titre_avant_les_colonnes'); ?>
<?php $largeur_de_la_colonne_titre = get_sub_field('largeur_de_la_colonne_titre'); ?>
<?php $separateur_de_la_colonne_titre = get_sub_field('separateur_de_la_colonne_titre'); ?>
<?php if ($titre_avant_les_colonnes) : ?>
    <div class="content_width zone_texte_avant_colonnes<?php if ($separateur_de_la_colonne_titre == 'pas_de_separateur_titre') : ?> zone_texte_avant_colonnes_nopadding<?php endif; ?>">
        <div class="<?php echo $largeur_de_la_colonne_titre; ?> entry-content">
            <?php echo $titre_avant_les_colonnes; ?>
        </div>
    </div>

    <?php if ($separateur_de_la_colonne_titre != 'pas_de_separateur_titre') : ?>
        <div class="content_width separateur_de_la_colonne_titre_wrapper_wrapper">
            <div class="separateur_de_la_colonne_titre_wrapper">
                <div class="separateur_de_la_colonne_titre <?php echo $separateur_de_la_colonne_titre; ?>"></div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- colonnes -->
<div class="content_width col_flexible col_flexible_1">
    <div class="extraits-clients-container">
        <?php foreach ($liste_des_clients_a_afficher as $client) :
            $client = $client['client_selectionne'];
            $title_client = $client->post_title;
            $clientId = $client->ID;
            $lien_vers_la_video = get_field('lien_vers_la_video', $clientId);
            $desc = get_field('description_extrait_de_la_page', $clientId);
            $problematique = get_field('problematique', $clientId);
            $permalink = get_permalink($clientId); ?>
            <div class="extrait-client">
                <div class="extrait-client__content">
                    <h3 class="extrait-client__title"><?php echo $title_client; ?></h3>
                    <p class="problematique"><?= $problematique ?></p>
                    <div class="extrait-client__description"><?php echo $desc; ?></div>
                    <div class="cta-container-cas-client">
                        <p class="cta_btn_lead cta_ternaire">
                            <a href="<?= $lien_vers_la_video ?>" class="extrait-client__link cta_ternaire"><?= $cta_texte_video_cas_client ?></a>
                        </p>
                        <p class="cta_btn_lead cta_primaire">
                            <a href="<?= $permalink; ?>" class="extrait-client__link"><?= $cta_cas_client_en_savoir_plus ?></a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php get_template_part('inc/content-builder-inc/cta.php'); ?>

</div>
<?php get_template_part('inc/content-builder-inc/visuel-fond-du-bloc') ?>

</div>