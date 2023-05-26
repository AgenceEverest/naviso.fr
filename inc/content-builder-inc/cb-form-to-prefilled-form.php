<!-- Un petit formulaire de contact dont “l’action” mène à la page de contact du site, avec deux input : 
un submit, qui est le bouton qui apparaît, et un input caché qui a en “value” la fonction the_title(), qui renvoie le nom de la page.  -->

<?php $url_de_la_page_contact = get_field('url_de_la_page_contact', 'option'); ?>
<?php $cb_calltoaction = get_sub_field('cb_call-to-action'); ?>
<?php $alignement_du_bouton = get_sub_field('alignement_du_bouton'); ?>
<?php $style_du_bouton = get_sub_field('style_du_bouton'); ?>
<?php $colonne1 = get_sub_field('colonne_1'); ?>
<?php $multicolonnes = get_sub_field('multicolonnes'); ?>
<?php $url_page_contact = the_permalink($url_de_la_page_contact->ID); ?>

<p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton; ?><?php if (!$colonne1) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo $url_page_contact; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
