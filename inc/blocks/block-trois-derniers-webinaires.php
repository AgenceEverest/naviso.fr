<?php

/**
 * Block Name: block-trois-derniers-webinaires
 *
 * Montre les trois derniers webinars
 */
if (have_rows('block_listant_les_webinaires')) : the_row();
	// CSS
	$cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
	$ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
	$couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
	$marge_en_haut_du_bloc = get_sub_field('marge_en_haut_du_bloc');
	$marge_en_bas_du_bloc = get_sub_field('marge_en_bas_du_bloc');
	$nombre_articles_liste = get_sub_field('nombre_articles_liste');
	$type_extrait = get_sub_field('type_extrait');
	$titre_du_bloc = get_sub_field('titre_du_bloc');
endif; ?>
<div <?php if ($ajouter_un_id_pour_le_css) : echo "id='" . $ajouter_un_id_pour_le_css . "' ";
		endif;
		echo 'class= "';
		if ($cb_ajouter_une_classe_css) : echo $cb_ajouter_une_classe_css . ' ';
		endif;
		if ($marge_en_haut_du_bloc) : echo 'padding_section_top ';
		endif;
		if ($marge_en_bas_du_bloc) : echo 'padding_section_bottom ';
		endif;
		if ($couleur_de_fond_bloc) : echo $couleur_de_fond_bloc;
		endif;
		echo ' block trois-derniers-webinars"' ?>>

	<div class="titre-accroche-bloc-webinar"><?= $titre_du_bloc ?></div>

	<?php $the_query = new WP_Query(array(
		'post_type' => 'webinaire',
		'posts_per_page' => $nombre_articles_liste,
		'order'     => 'DESC',
		'post_status'       => 'publish',
	));
	?>

	<div id="result" class="padding_section">
		<div id="liste_resultats" class="content_width">
			<?php while ($the_query->have_posts()) : $the_query->the_post();
				get_template_part('inc/extrait-webinaire');
			endwhile; ?>
		</div>
	</div>

	<?php wp_reset_query(); ?>

	<?php
	$cb_calltoaction_lien = get_sub_field('cb_call-to-action_lien');
	$cb_calltoaction_interne_externe = get_sub_field('lien_interne_ou_externe_');
	$ouvrir_dans_un_nouvel_onglet = get_sub_field('ouvrir_dans_un_nouvel_onglet');
	$cb_calltoaction = get_sub_field('cb_call-to-action');
	$cb_calltoaction_url = get_sub_field('cb_call-to-action_url');
	$cb_calltoaction_fichier = get_sub_field('cb_call-to-action_fichier');
	$cb_calltoaction_fichier_size = filesize(get_attached_file($cb_calltoaction_fichier));
	$style_du_bouton = get_sub_field('style_du_bouton');
	?>
	<!-- Lien page contact pré-remplie -->
	<?php if ($cb_calltoaction_interne_externe == 'page_contact') :
		get_template_part('inc/content-builder-inc/cb-form-to-prefilled-form');
	endif; ?>

	<!-- Lien interne  -->
	<?php if ($cb_calltoaction_interne_externe == 'lien_interne') : ?>
		<?php if ($cb_calltoaction_lien) : ?>
			<p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton; ?>"><a href="<?php echo $cb_calltoaction_lien; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
		<?php endif; ?>
	<?php endif; ?>

	<!-- Lien externe  -->
	<?php if ($cb_calltoaction_interne_externe == 'lien_externe') : ?>
		<?php if ($cb_calltoaction_url) : ?>
			<p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton; ?>"><a href="<?php echo $cb_calltoaction_url; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
		<?php endif; ?>
	<?php endif; ?>

	<!-- Fichier à télécharger  -->
	<?php if ($cb_calltoaction_interne_externe == 'fichier_telechargement') : ?>
		<?php if ($cb_calltoaction_fichier) : ?>
			<p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $style_du_bouton; ?>"><a href="<?php echo wp_get_attachment_url($cb_calltoaction_fichier); ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>>
					<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path>
					</svg><?php echo $cb_calltoaction; ?> <span class="download_doc_size">- <?php echo size_format($cb_calltoaction_fichier_size, $decimals = 0); ?></span></a></p>
		<?php endif; ?>
	<?php endif; ?>
	<div class="svg-container vague-webinar">
		<?= showSvg(get_stylesheet_directory_uri() . '/svg/grande-vague-milieu.svg'); ?>
	</div>
</div>