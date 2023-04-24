<?php $image_alt = get_post_thumbnail_id($post->ID)  ? get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', TRUE) : null; ?>
<?php $couleur_lie_au_metier = get_field('choix_de_couleur_pour_le_metier', $post->ID); ?>
<div class="offre_extrait extrait_metier" style="border-bottom: 6px solid <?= $couleur_lie_au_metier ?>">
	<div>
		<h3>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php $descriptionextraitdelapage = get_field('description_extrait_de_la_page', $post->ID);
		?>
		<p class="desc"><?= $descriptionextraitdelapage ?></p>
		<?php $call_to_action_sur_les_extraits_des_metiers = get_field('call_to_action_sur_les_extraits_des_metiers', 'option'); ?>
		<p class="cta_btn_lead cta_ternaire">
			<a href="<?php the_permalink(); ?>">
				<?= $call_to_action_sur_les_extraits_des_metiers; ?>
			</a>
		</p>
	</div>
</div>