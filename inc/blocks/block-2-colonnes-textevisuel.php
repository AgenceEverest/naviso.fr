<?php

/**
 * Block Name: block-2-colonnes-textevisuel  
 *
 * This is the template that displays the 2-colonnes-texte-visuel block.
 */
if (have_rows('block_2_colonnes_textevisuel')) : the_row(); // il s'agit du nom du champ dans ACF qui contient les sous-champs
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
	<div class="content_width col_double">
		<!-- col left -->
		<div class="col_left">
			<div class="col_left_wrapper">
				<!-- visuel -->
				<?php
				if (have_rows('cb_type_de_visuel')) :
					while (have_rows('cb_type_de_visuel')) : the_row();
						switch (get_row_layout()) {
							case 'cb_image_simple':
								get_template_part('inc/content-builder-inc/cb-image-simple');
								break;
							case 'cb_video_iframe':
								get_template_part('inc/content-builder-inc/cb-video-iframe');
								break;
						}
					endwhile;
				else :
				endif; ?>
			</div>
		</div>
		<!-- col right -->
		<div class="col_right">
			<div class="col_right_wrapper entry-content col_right_wrapper_padding">
				<?php the_sub_field('cb_contenu_texte'); ?>

				<?php
				$ajouter_un_call_to_action = get_sub_field('ajouter_un_call-to-action');
				$position_du_bouton = get_sub_field('position_du_bouton');
				$ajouter_un_deuxieme_call_to_action = get_sub_field('ajouter_un_deuxieme_call-to-action'); ?>
				<?php if ($ajouter_un_call_to_action) : ?>
					<div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
												endif; ?>">
						<?php if (have_rows('call-to-action')) : ?>
							<?php while (have_rows('call-to-action')) : the_row(); ?>
								<?php get_template_part('inc/content-builder-inc/cta-col'); ?>
							<?php endwhile; ?>
						<?php endif; ?>
						<?php if (have_rows('call-to-action_2') && $ajouter_un_deuxieme_call_to_action) : ?>
							<?php while (have_rows('call-to-action_2')) : the_row(); ?>
								<?php get_template_part('inc/content-builder-inc/cta-col'); ?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
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
	<?php if ($marge_interne_en_haut_du_bloc) : ?>
		<?php echo " padding_section_top"; ?>
	<?php endif; ?>
	<?php if ($marge_interne_en_bas_du_bloc) : ?>
		<?php echo " padding_section_bottom"; ?>
	<?php endif; ?>
	<?php if ($couleur_de_fond_bloc) : ?>
		<?php echo " " . $couleur_de_fond_bloc; ?>
	<?php endif; ?>
	<?php if ($cb_ajouter_une_classe_css) : ?>
		<?php echo " " . $cb_ajouter_une_classe_css . ""; ?>
	<?php endif; ?>
	<?php echo " block block-2-colonnes-textevisuel '>"; ?>
	<div class="content_width col_double">
		<!-- col left -->
		<div class="col_left">
			<div class="col_left_wrapper entry-content col_left_wrapper_padding">
				<?php the_sub_field('cb_contenu_texte'); ?>
				<?php
				$ajouter_un_call_to_action = get_sub_field('ajouter_un_call-to-action');
				$position_du_bouton = get_sub_field('position_du_bouton');
				$ajouter_un_deuxieme_call_to_action = get_sub_field('ajouter_un_deuxieme_call-to-action'); ?>
				<?php if ($ajouter_un_call_to_action) : ?>
					<div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
												endif; ?>">
						<?php if (have_rows('call-to-action')) : ?>
							<?php while (have_rows('call-to-action')) : the_row(); ?>
								<?php get_template_part('inc/content-builder-inc/cta-col'); ?>
							<?php endwhile; ?>
						<?php endif; ?>
						<?php if (have_rows('call-to-action_2') && $ajouter_un_deuxieme_call_to_action) : ?>
							<?php while (have_rows('call-to-action_2')) : the_row(); ?>
								<?php get_template_part('inc/content-builder-inc/cta-col'); ?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<!-- col right -->
		<div class="col_right">
			<div class="col_right_wrapper">
				<!-- visuel -->
				<?php
				if (have_rows('cb_type_de_visuel')) :
					while (have_rows('cb_type_de_visuel')) : the_row();
						switch (get_row_layout()) {
							case 'cb_image_simple':
								get_template_part('inc/content-builder-inc/cb-image-simple');
								break;
							case 'cb_video_iframe':
								get_template_part('inc/content-builder-inc/cb-video-iframe');
								break;
						}
					endwhile;
				else :
				endif; ?>
			</div>
		</div>
	</div>
	<?php get_template_part('inc/content-builder-inc/visuel-fond-du-bloc') ?>

	</div>
<?php endif; ?>