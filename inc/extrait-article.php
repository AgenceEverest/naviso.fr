<article id="post-<?php the_ID(); ?>" <?php post_class('article_extrait'); ?>>
	<div class="article_extrait_thumbnail">
		<?php $image_url = get_the_post_thumbnail_url(get_the_ID(), 'image-principale-blog');
		$image_weight = $image_url ? apply_filters('get_weight_of_img', $image_url) : '0kb';
		$thumbnail_id = get_post_thumbnail_id(get_the_ID());
		$thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
		?>
		<a href="<?php the_permalink(); ?>" class="image_article_wrapper">
			<figure>
				<?php if ($image_url) : ?>
					<div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>
				<?php endif; ?>
				<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo $image_url; ?>" alt="<?php echo $thumbnail_alt; ?>">
			</figure>
		</a>
	</div>
	<div class="article_extrait_wrapper_text">
		<p class="entry_title_date legende">
			<?php 
				$domaine_terms = get_the_terms(get_the_ID(), 'category');
				if (
					$domaine_terms
					&& !is_wp_error($domaine_terms)
				) {
					@usort($domaine_terms, function ($a, $b) {
						return strcasecmp(
							$a->slug,
							$b->slug
						);
					});
					$term_list = [];
					foreach ($domaine_terms as $term)
						$term_list[] = '<a href="' . get_term_link($term) . '" class="term_link">' . esc_html($term->name) . '</a>';
					echo implode(', ', $term_list);
				}
			?>
		</p>
		<h2 class="article_extrait_post_title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
        <?php $description_extrait_de_la_page = get_field("description_extrait_de_la_page"); 
            if ($description_extrait_de_la_page){
                echo "<p class='article_extrait_post_desc'>" . $description_extrait_de_la_page . "</p>";
            }
            ?>
	</div>
    <?php $calltoactiondesextraitsdarticles = get_field('call-to-action_des_extraits_darticles', 'option'); ?>
    <p class="cta_btn_lead cta_primaire cta_extrait_article">
        <a aria-hidden="true" href="<?php the_permalink(); ?>">
            <?php echo $calltoactiondesextraitsdarticles; ?>
        </a>
    </p>
</article>