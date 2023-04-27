<?php

/**
 * Block Name: block-2-colonnes-superposition
 *
 * This is the template that displays the 2-colonnes-texte block.
 */
if (have_rows('block_contacter_expert_logiciel')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
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
    $titre_avant_les_colonnes = get_sub_field('titre_avant_les_colonnes');
    $largeur_de_la_colonne_titre = get_sub_field('largeur_de_la_colonne_titre');
    $separateur_de_la_colonne_titre = get_sub_field('separateur_de_la_colonne_titre');
    $colonne_1 = get_sub_field('colonne_1');
    $colonne_2 = get_sub_field('colonne_2');
endif;
?>
<?php echo "<div "; ?>
<?php if ($ajouter_un_id_pour_le_css) :
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
    echo " block-contacter-expert ";
    echo " block '>" ?>

<!-- titre avant les colonnes-->

<?php if ($titre_avant_les_colonnes) : ?>
    <div class="content_width zone_texte_avant_colonnes<?php if (!$colonne_1 and $separateur_de_la_colonne_titre == 'pas_de_separateur_titre') : ?> zone_texte_avant_colonnes_nopadding<?php endif; ?>">
        <div class="<?php echo $largeur_de_la_colonne_titre; ?> entry-content">
            <?php echo $titre_avant_les_colonnes; ?>
        </div>
    </div>

    <?php if ($separateur_de_la_colonne_titre != 'pas_de_separateur_titre') : ?>
        <div class="content_width separateur_de_la_colonne_titre_wrapper_wrapper<?php if ($colonne_1) : ?> separateur_de_la_colonne_titre_space<?php endif; ?>">
            <div class="separateur_de_la_colonne_titre_wrapper">
                <div class="separateur_de_la_colonne_titre <?php echo $separateur_de_la_colonne_titre; ?>"></div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- colonnes -->
<div class="content_width col_flexible col_flexible_2">
    <!-- Les 2 colonnes -->
    <?php $proportions_des_colonnes = get_sub_field('proportions_des_colonnes'); ?>
    <div class="col_flexible_wrapper col_flexible_superposition <?php echo $proportions_des_colonnes; ?>">
        <!-- Colonne 1 -->
        <div class="col-gauche">
            <?php foreach ($colonne_1 as $item) :
                $picto = $item['picto'];
                $question_de_la_liste = $item['question_de_la_liste']; ?>
                <div class="col_flexible_item">
                    <div class="col_flexible_item_wrapper">
                        <div class="col_flexible_item_picto">
                            <img src="<?php echo $picto; ?>" />
                        </div>
                        <div class="col_flexible_item_texte">
                            <?php echo $question_de_la_liste; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
        <!-- Colonne 2 -->
        <div class="col-droite">
            <?php $titre_de_la_colonne = $colonne_2['titre_de_la_colonne'];
            $texte_de_la_colonne = $colonne_2['texte_de_la_colonne'];
            $afficher_le_bouton = $colonne_2['afficher_le_bouton'];
            $texte_du_bouton_de_la_colonne = $colonne_2['texte_du_bouton_de_la_colonne'];
            $lien_du_bouton_de_la_colonne = $colonne_2['lien_du_bouton_de_la_colonne'];
            $url_du_bouton = $lien_du_bouton_de_la_colonne ? $lien_du_bouton_de_la_colonne['url'] : '';
            ?>
            <h3><?= $titre_de_la_colonne ?></h3>
            <p><?= $texte_de_la_colonne ?></p>
            <?php if ($afficher_le_bouton) : ?>
                <p class="cta_btn_lead"><a target="_blank" href="<?= $url_du_bouton ?>" class="btn btn-primary"><?= $texte_du_bouton_de_la_colonne ?></a></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Lien page contact pré-remplie -->
<?php if ($cb_calltoaction_interne_externe == 'page_contact') : ?>
    <?php get_template_part('inc/content-builder-inc/cb-form-to-prefilled-form'); ?>
<?php endif; ?>

<!-- Lien interne  -->
<?php if ($cb_calltoaction_interne_externe == 'lien_interne') : ?>
    <?php if ($cb_calltoaction_lien) : ?>
        <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?><?php if (!$colonne_1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_lien; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
    <?php endif; ?>
<?php endif; ?>

<!-- Lien externe  -->
<?php if ($cb_calltoaction_interne_externe == 'lien_externe') : ?>
    <?php if ($cb_calltoaction_url) : ?>
        <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?><?php if (!$colonne_1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_url; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
    <?php endif; ?>
<?php endif; ?>

<!-- Fichier à télécharger  -->
<?php if ($cb_calltoaction_interne_externe == 'fichier_telechargement') : ?>
    <?php if ($cb_calltoaction_fichier) : ?>
        <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?><?php if ((!$colonne_1) && ($separateur_de_la_colonne_titre = 'pas_de_separateur_titre')) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo wp_get_attachment_url($cb_calltoaction_fichier); ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path>
                </svg><?php echo $cb_calltoaction; ?> <span class="download_doc_size">- <?php echo size_format($cb_calltoaction_fichier_size, $decimals = 0); ?></span></a></p>
    <?php endif; ?>
<?php endif; ?>

</div>
<?php get_template_part('inc/content-builder-inc/visuel-fond-du-bloc') ?>

</div>