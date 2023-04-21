<div class="offre_extrait">
	<div class="offre_extrait_photo">
		<?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
		<?php $image_alt = get_post_thumbnail_id($post->ID)  ? get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', TRUE) : null; ?>
		<?php $image_weight = $thumbnail ? apply_filters('get_weight_of_img', $thumbnail['0']) : '0kb'; ?>
		<?php $couleur_lie_au_metier = get_field('choix_de_couleur_pour_le_metier'); ?>
		<a href="<?php the_permalink(); ?>">
			<figure>
				<div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>
				<?php if ($thumbnail) : ?>
					<img src="<?php echo $thumbnail['0'] ?>" alt="<?= $image_alt ?>" />
				<?php endif; ?>
			</figure>
			<div class="offre_thumb_degrade"></div>
			<h3 class="offre_extrait_photo_title anim_bottom_top">
				<?php the_title(); ?>
			</h3>
		</a>
		<!-- <h3 class="anim_left_right">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3> -->
	</div>
	<div class="offre_extrait_content" style="background-color: <?= $couleur_lie_au_metier ?>">
		<!-- <h3 class="anim_left_right">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3> -->
		<?php $descriptionextraitdelapage = get_field('description_extrait_de_la_page');
		echo "<p class='anim_top_bottom'>" . $descriptionextraitdelapage . " (…)</p>";
		?>
		<p class="offre_extrait_cta legende anim_top_bottom">
			<?php $calltoactionsurlesextraitsdesoffres = get_field('call-to-action_sur_les_extraits_des_offres', 'option'); ?>
			<a href="<?php the_permalink(); ?>" class="btn"><?php echo $calltoactionsurlesextraitsdesoffres; ?></a>
		</p>
	</div>
</div>