<?php $image_alt = get_post_thumbnail_id($post->ID)  ? get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', TRUE) : null; ?>
<?php $couleur_lie_au_metier = get_field('choix_de_couleur_pour_le_metier', $post->ID); ?>
<?php $descriptionextraitdelapage = get_field('description_extrait_de_la_page', $post->ID); ?>
<?php $call_to_action_sur_les_extraits_des_metiers = get_field('call_to_action_sur_les_extraits_des_metiers', 'option'); ?>
<?php $texte_bouton_en_savoir_plus = get_sub_field('texte_bouton_en_savoir_plus'); ?>
<?php $nom_de_lanimateur = get_field('nom_de_lanimateur', $post->ID) ?>
<div class="offre_extrait extrait_metier">
	<div>
		<h3>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<p class="nom-animateur"><?= $nom_de_lanimateur ?></p>
		<p class="desc"><?= $descriptionextraitdelapage ?></p>
		<p class="cta_btn_lead cta_ternaire">
			<a href="<?php the_permalink(); ?>">
				<?= $texte_bouton_en_savoir_plus; ?>
			</a>
		</p>
	</div>

</div>