<?php

/**
 * Block Name: block-2-colonnes-textevisuel-large
 *
 * This is the template that displays the 2-colonnes-texte-visuel (large) block.
 */
if (have_rows('block_2_colonnes_textevisuel_large')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
	$cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
	$ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
	$couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
	$cb_calltoaction = get_sub_field('cb_call-to-action');
	$cb_calltoaction_lien = get_sub_field('cb_call-to-action_lien');
	$cb_calltoaction_url = get_sub_field('cb_call-to-action_url');
	$cb_calltoaction_fichier = get_sub_field('cb_call-to-action_fichier');
	$cb_calltoaction_fichier_size = filesize(get_attached_file($cb_calltoaction_fichier));
	$cb_calltoaction_interne_externe = get_sub_field('lien_interne_ou_externe_');
	$ouvrir_dans_un_nouvel_onglet = get_sub_field('ouvrir_dans_un_nouvel_onglet');
	$alignement_du_bouton = get_sub_field('alignement_du_bouton');
	$style_du_bouton = get_sub_field('style_du_bouton');
    $ajouter_un_deuxieme_call_to_action = get_sub_field('ajouter_un_deuxieme_call-to-action');


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
?>
<!-- Visuel à gauche -->
<?php if (get_sub_field('contentbuilder_visuel_a_gauche_ou_a_droite') == 'gauche') : ?>
	<?php echo "<div "; ?>
	<?php if ($ajouter_un_id_pour_le_css) : ?>
		<?php echo " id='" . $ajouter_un_id_pour_le_css . "'"; ?>
	<?php endif; ?>
	<?php echo " class='"; ?>
	<?php if ($couleur_de_fond_bloc) : ?>
		<?php echo " " . $couleur_de_fond_bloc; ?>
	<?php endif; ?>
	<?php if ($cb_ajouter_une_classe_css) : ?>
		<?php echo " " . $cb_ajouter_une_classe_css . ""; ?>
	<?php endif; ?>
	<?php echo "'>"; ?>
	<div class="col_double_wide_imgleft">
		<div class="col_left_wide_imgleft">
			<?php if (have_rows('image_de_fond')) : ?>
				<?php while (have_rows('image_de_fond')) : the_row();
					$image_de_fond = get_sub_field('cb_contenu_image_fond');
					$size_image_de_fond = 'large';
					$url_image_de_fond = $image_de_fond ? wp_get_attachment_image_url($image_de_fond, $size_image_de_fond) : null;
					$image_weight =  $url_image_de_fond ? apply_filters('get_weight_of_img', $url_image_de_fond) : '0kb';
					$copyright_image_de_fond = get_sub_field('copyright_image_de_fond');
					$phrase_sur_limage = get_sub_field('phrase_sur_limage');
				?>
					<div class="col_left_wide_imgleft_img">

						<figure>
							<div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>
							<?php $image_large = wp_get_attachment_image_src($image_de_fond, $size_image_de_fond);
							$alt_text = get_post_meta($image_de_fond, '_wp_attachment_image_alt', true); ?>
							<?php if ($phrase_sur_limage) : ?>
								<img src="<?php echo $image_large[0]; ?>" class="col_wide_img_transparent" width="<?php echo $image_large[1]; ?>" height="<?php echo $image_large[2]; ?>" alt="<?php echo $alt_text; ?>" loading="lazy">
							<?php else : ?>
								<img src="<?php echo $image_large[0]; ?>" class="col_wide_img_opacity" width="<?php echo $image_large[1]; ?>" height="<?php echo $image_large[2]; ?>" alt="<?php echo $alt_text; ?>" loading="lazy">
							<?php endif; ?>
						</figure>

						<?php if ($copyright_image_de_fond) : ?>
							<p class="copyright_image"><span class="copyright_image_txt"><?php echo $copyright_image_de_fond; ?></span><span class="copyright_image_bg"></span></p>
						<?php endif; ?>
						<?php if ($phrase_sur_limage) : ?>
							<div class="col_left_wide_imgleft_img_texte">
								<p><?php echo $phrase_sur_limage; ?></p>
							</div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div class="col_right_wide_imgleft padding_section">
			<div class="col_right_wide_imgleft_wrapper entry-content">
				<?php the_sub_field('cb_contenu_texte'); ?>

				<div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
											endif; ?>">
					<?php if (have_rows('call-to-action')) : ?>
						<?php while (have_rows('call-to-action')) : the_row(); ?>
							<?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php if (have_rows('call-to-action_2') && $ajouter_un_deuxieme_call_to_action) : ?>
						<?php while (have_rows('call-to-action_2')) : the_row(); ?>
							<?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php endif; ?>
<!-- Visuel à droite -->
<?php if (get_sub_field('contentbuilder_visuel_a_gauche_ou_a_droite') == 'droite') : ?>
	<?php echo "<div "; ?>
	<?php if ($ajouter_un_id_pour_le_css) : ?>
		<?php echo " id='" . $ajouter_un_id_pour_le_css . "'"; ?>
	<?php endif; ?>
	<?php echo " class='"; ?>
	<?php if ($couleur_de_fond_bloc) : ?>
		<?php echo " " . $couleur_de_fond_bloc; ?>
	<?php endif; ?>
	<?php if ($cb_ajouter_une_classe_css) : ?>
		<?php echo " " . $cb_ajouter_une_classe_css . ""; ?>
	<?php endif; ?>
	<?php echo "'>"; ?>	

	<div class="col_double_wide_imgright">
		<div class="col_left_wide_imgright padding_section">
			<div class="col_left_wide_imgright_wrapper entry-content">
				<?php the_sub_field('cb_contenu_texte'); ?>
				<div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
											endif; ?>">
					<?php if (have_rows('call-to-action')) : ?>
						<?php while (have_rows('call-to-action')) : the_row(); ?>
							<?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php if (have_rows('call-to-action_2') && $ajouter_un_deuxieme_call_to_action) : ?>
						<?php while (have_rows('call-to-action_2')) : the_row(); ?>
							<?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col_right_wide_imgright">
			<?php if (have_rows('image_de_fond')) : ?>
				<?php while (have_rows('image_de_fond')) : the_row();
					$image_de_fond = get_sub_field('cb_contenu_image_fond');
					$size_image_de_fond = 'large';
					$url_image_de_fond = wp_get_attachment_image_url($image_de_fond, $size_image_de_fond);
					$image_weight = apply_filters('get_weight_of_img', $url_image_de_fond);
					$copyright_image_de_fond = get_sub_field('copyright_image_de_fond');
					$phrase_sur_limage = get_sub_field('phrase_sur_limage');
				?>
					<div class="col_right_wide_imgright_img">
						<figure>
							<div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>
							<?php $image_large = wp_get_attachment_image_src($image_de_fond, $size_image_de_fond);
							$alt_text = get_post_meta($image_de_fond, '_wp_attachment_image_alt', true); ?>
							<?php if ($phrase_sur_limage) : ?>
								<img src="<?php echo $image_large[0]; ?>" class="col_wide_img_transparent" width="<?php echo $image_large[1]; ?>" height="<?php echo $image_large[2]; ?>" alt="<?php echo $alt_text; ?>" loading="lazy">
							<?php else : ?>
								<img src="<?php echo $image_large[0]; ?>" class="col_wide_img_opacity" width="<?php echo $image_large[1]; ?>" height="<?php echo $image_large[2]; ?>" alt="<?php echo $alt_text; ?>" loading="lazy">
							<?php endif; ?>
						</figure>
						<?php if ($copyright_image_de_fond) : ?>
							<p class="copyright_image"><span class="copyright_image_txt"><?php echo $copyright_image_de_fond; ?></span><span class="copyright_image_bg"></span></p>
						<?php endif; ?>
						<?php if ($phrase_sur_limage) : ?>
							<div class="col_right_wide_imgright_img_texte">
								<p><?php echo $phrase_sur_limage; ?></p>
							</div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
						</div>
	</div>
	</div>
	
<?php endif; ?>

<div class="cta-sous-bloc-container">
			<?php if ($afficher_un_premier_bouton_sous_le_bloc) : ?>
				<!-- Lien page contact pré-remplie -->
				<?php if ($cb_calltoaction_interne_externe == 'page_contact') :
					get_template_part('inc/content-builder-inc/cb-form-to-prefilled-form');
				endif; ?>

				<!-- Lien interne  -->
				<?php if ($cb_calltoaction_interne_externe == 'lien_interne') : ?>
					<?php if ($cb_calltoaction_lien) : ?>
						<p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?> cta_btn_lead_margintop"><a href="<?php echo $cb_calltoaction_lien; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
					<?php endif; ?>
				<?php endif; ?>

				<!-- Lien externe  -->
				<?php if ($cb_calltoaction_interne_externe == 'lien_externe') : ?>
					<?php if ($cb_calltoaction_url) : ?>
						<p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?> cta_btn_lead_margintop"><a href="<?php echo $cb_calltoaction_url; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction; ?></a></p>
					<?php endif; ?>
				<?php endif; ?>

				<!-- Fichier à télécharger  -->
				<?php if ($cb_calltoaction_interne_externe == 'fichier_telechargement') : ?>
					<?php if ($cb_calltoaction_fichier) : ?>
						<p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $alignement_du_bouton; ?> <?php echo $style_du_bouton; ?><?php if (($separateur_de_la_colonne_titre = 'pas_de_separateur_titre')) : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo wp_get_attachment_url($cb_calltoaction_fichier); ?>" <?php if ($ouvrir_dans_un_nouvel_onglet) : ?> target="_blank" <?php endif; ?>><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
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
						<p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton_2; ?> cta_btn_lead_margintop"><a href="<?php echo $cb_calltoaction_lien_2; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet_2) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction_2; ?></a></p>
					<?php endif; ?>
				<?php endif; ?>

				<!-- Lien externe  -->
				<?php if ($cb_calltoaction_interne_externe_2 == 'lien_externe') : ?>
					<?php if ($cb_calltoaction_url_2) : ?>
						<p class="cta_sous_colonnes_flex cta_btn_lead  <?php echo $style_du_bouton_2; ?> cta_btn_lead_margintop"><a href="<?php echo $cb_calltoaction_url_2; ?>" <?php if ($ouvrir_dans_un_nouvel_onglet_2) : ?> target="_blank" <?php endif; ?>><?php echo $cb_calltoaction_2; ?></a></p>
					<?php endif; ?>
				<?php endif; ?>

				<!-- Fichier à télécharger  -->
				<?php if ($cb_calltoaction_interne_externe_2 == 'fichier_telechargement') : ?>
					<?php if ($cb_calltoaction_fichier_2) : ?>
						<p class="cta_sous_colonnes_flex cta_btn_lead <?php echo $style_du_bouton_2; ?><?php if ($separateur_de_la_colonne_titre = 'pas_de_separateur_titre') : ?> cta_btn_lead_margintop<?php endif; ?>"><a href="<?php echo wp_get_attachment_url($cb_calltoaction_fichier_2); ?>" <?php if ($ouvrir_dans_un_nouvel_onglet_2) : ?> target="_blank" <?php endif; ?>><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
									<path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path>
								</svg><?php echo $cb_calltoaction_2; ?> <span class="download_doc_size">- <?php echo size_format($cb_calltoaction_fichier_size_2, $decimals = 0); ?></span></a></p>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>