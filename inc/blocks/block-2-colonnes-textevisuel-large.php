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

	$marge_externe_en_haut_du_bloc = get_sub_field('marge_externe_en_haut_du_bloc');
	$marge_externe_en_bas_du_bloc = get_sub_field('marge_externe_en_bas_du_bloc');
	$marge_interne_en_haut_du_bloc = get_sub_field('marge_interne_en_haut_du_bloc');
	$marge_interne_en_bas_du_bloc = get_sub_field('marge_interne_en_bas_du_bloc');

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
	<?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) :
		echo ' deux-cta-sous-bloc';
	endif; ?>
	<?php
	if ($marge_interne_en_haut_du_bloc) :
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
	endif;
	?>
	<?php echo " block '>" ?>
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

	<?php $position_CTA = get_sub_field('position_des_deux_cta_sous_le_bloc') ?>

	<div class="cta-sous-bloc-container <?= $position_CTA ?>">
		<?php if ($afficher_un_premier_bouton_sous_le_bloc) : ?>
			<?php get_template_part('inc/content-builder-inc/cta-sous-bloc-1') ?>
		<?php endif; ?>
		<?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) : ?>
			<?php get_template_part('inc/content-builder-inc/cta-sous-bloc-2') ?>
		<?php endif; ?>
	</div>
	<?php get_template_part('inc/content-builder-inc/visuel-fond-du-bloc') ?>

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
	<?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) :
		echo ' deux-cta-sous-bloc';
	endif; ?>
	<?php echo " block '>"; ?>

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
	<?php $position_CTA = get_sub_field('position_des_deux_cta_sous_le_bloc') ?>

	<div class="cta-sous-bloc-container <?= $position_CTA ?>">
		<?php if ($afficher_un_premier_bouton_sous_le_bloc) : ?>
			<?php get_template_part('inc/content-builder-inc/cta-sous-bloc-1') ?>
		<?php endif; ?>
		<?php if ($afficher_un_deuxieme_bouton_sous_le_bloc) : ?>
			<?php get_template_part('inc/content-builder-inc/cta-sous-bloc-2') ?>
		<?php endif; ?>
	</div>
	<?php get_template_part('inc/content-builder-inc/visuel-fond-du-bloc') ?>

	</div>

<?php endif; ?>