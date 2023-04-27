<?php

$cb_calltoaction_fichier_size = get_sub_field('cb_calltoaction_fichier_size');
$cb_calltoaction_lien = get_sub_field('cb_call-to-action_lien');
$cb_calltoaction_interne_externe = get_sub_field('lien_interne_ou_externe_');
$ouvrir_dans_un_nouvel_onglet = get_sub_field('ouvrir_dans_un_nouvel_onglet');
$cb_calltoaction = get_sub_field('cb_call-to-action');
$cb_calltoaction_url = get_sub_field('cb_call-to-action_url');
$cb_calltoaction_fichier = get_sub_field('cb_call-to-action_fichier');
$style_du_bouton = get_sub_field('style_du_bouton');
$separateur_de_la_colonne_titre = get_sub_field('separateur_de_la_colonne_titre');
$colonne1 = get_sub_field('colonne_1');
?>
<!-- Lien page contact pré-remplie -->
<?php if ($cb_calltoaction_interne_externe == 'page_contact') :
    get_template_part('inc/content-builder-inc/cb-form-to-prefilled-form');
endif; ?>

<!-- Lien interne  -->
<?php if ($cb_calltoaction_interne_externe == 'lien_interne') : ?>
    <?php if ($cb_calltoaction_lien) : ?>
        <p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton; ?><?php if (!$colonne1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_lien; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
    <?php endif; ?>
<?php endif; ?>

<!-- Lien externe  -->
<?php if ($cb_calltoaction_interne_externe == 'lien_externe') : ?>
    <?php if ($cb_calltoaction_url) : ?>
        <p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton; ?><?php if (!$colonne1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $cb_calltoaction_url; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
    <?php endif; ?>
<?php endif; ?>

<!-- Fichier à télécharger  -->
<?php if ($cb_calltoaction_interne_externe == 'fichier_telechargement') : ?>
    <?php if ($cb_calltoaction_fichier) : ?>
        <p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $style_du_bouton; ?><?php if ((!$colonne1) && ($separateur_de_la_colonne_titre = 'pas_de_separateur_titre')) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo wp_get_attachment_url($cb_calltoaction_fichier); ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path>
                </svg><?php echo $cb_calltoaction; ?> <span class="download_doc_size">- <?php echo size_format($cb_calltoaction_fichier_size, $decimals = 0); ?></span></a></p>
    <?php endif; ?>
<?php endif; ?>