<?php $fil_ariane_accueil = get_field('fil_ariane_accueil', 'option'); ?>

<!-- Page simple -->
<?php
if (is_page() && !$post->post_parent) : ?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span></p>
		</nav>
	</div>
<?php endif; ?>

<!-- Page simple avec page parente -->
<?php
if (is_page() && $post->post_parent) : ?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Single offres -->
<?php
if (is_singular('offres')) : ?>
	<?php $page_qui_liste_les_offres = get_field('page_qui_liste_les_offres', 'option');
	$page_qui_liste_les_offres_id = $page_qui_liste_les_offres->ID;
	$page_qui_liste_les_offres_permalink = get_permalink($page_qui_liste_les_offres_id);
	$page_qui_liste_les_offres_title = get_the_title($page_qui_liste_les_offres_id);
	?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?php echo $page_qui_liste_les_offres_permalink; ?>"><?php echo $page_qui_liste_les_offres_title; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Single clients -->
<?php
if (is_singular('client')) : ?>
	<?php $page_qui_liste_les_clients = get_field('page_qui_liste_les_clients', 'option');
	$page_qui_liste_les_clients_id = $page_qui_liste_les_clients->ID;
	$page_qui_liste_les_clients_permalink = get_permalink($page_qui_liste_les_clients_id);
	$page_qui_liste_les_clients_title = get_the_title($page_qui_liste_les_clients_id);
	?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?php echo $page_qui_liste_les_clients_permalink; ?>"><?php echo $page_qui_liste_les_clients_title; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Single formation -->
<?php
if (is_singular('formation')) : ?>
	<?php $page_qui_liste_les_formations = get_field('page_qui_liste_les_formations', 'option');
	$page_qui_liste_les_formations_id = $page_qui_liste_les_formations->ID;
	$page_qui_liste_les_formations_permalink = get_permalink($page_qui_liste_les_formations_id);
	$page_qui_liste_les_formations_title = get_the_title($page_qui_liste_les_formations_id);
	?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?php echo $page_qui_liste_les_formations_permalink; ?>"><?php echo $page_qui_liste_les_formations_title; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Single formation -->
<?php
if (is_singular('metier')) : ?>
	<?php $page_qui_liste_les_metiers = get_field('page_qui_liste_les_metiers', 'option');
	$page_qui_liste_les_metiers_id = $page_qui_liste_les_metiers->ID;
	$page_qui_liste_les_metiers_permalink = get_permalink($page_qui_liste_les_metiers_id);
	$page_qui_liste_les_metiers_title = get_the_title($page_qui_liste_les_metiers_id);
	?>
	<div class="breadcrumb_container">

		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?php echo $page_qui_liste_les_metiers_permalink; ?>"><?php echo $page_qui_liste_les_metiers_title; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Single logiciel -->
<?php
if (is_singular('logiciel')) : ?>
	<?php $page_qui_liste_les_logiciels = get_field('page_qui_liste_les_logiciels', 'option');
	$page_qui_liste_les_logiciels_id = $page_qui_liste_les_logiciels->ID;
	$page_qui_liste_les_logiciels_permalink = get_permalink($page_qui_liste_les_logiciels_id);
	$page_qui_liste_les_logiciels_title = get_the_title($page_qui_liste_les_logiciels_id);
	?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?php echo $page_qui_liste_les_logiciels_permalink; ?>"><?php echo $page_qui_liste_les_logiciels_title; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span>
		</nav>

	</div>
<?php endif; ?>

<!-- Single post -->
<?php
if (is_singular('post')) : ?>
	<?php $page_for_posts = get_field('page_for_posts', 'option');
	if (isset($page_for_posts)) {
		$permalinkPosts = get_permalink($page_for_posts->ID);
		$titlePosts = get_the_title($page_for_posts->ID);
	}
	?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?= $permalinkPosts; ?>"><?= $titlePosts; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php the_title(); ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Archive blog -->
<?php
if (is_home()) : ?>
	<?php $page_for_posts = get_option(''); ?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>">
					<?php echo $fil_ariane_accueil; ?></a>
				<span class="breadcrumb_separator">›</span><span aria-current='location'><?php echo get_the_title($page_for_posts); ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Archive category -->
<?php
if (is_category()) : ?>
	<?php $titresdelapageactualites = get_field('titre_de_la_page_actualites', 'option'); ?>
	<?php $term = get_queried_object(); ?>
	<?php $page_for_posts = get_option('page_for_posts'); ?>
	<div class="breadcrumb_container">

		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><a href="<?php echo get_permalink($page_for_posts); ?>"><?php echo get_the_title($page_for_posts); ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php echo "$term->name" ?></span>
			</p>
		</nav>
	</div>
<?php endif; ?>

<!-- Page recherche -->
<?php
if (is_search()) : ?>
	<?php $fil_ariane_resultats_recherche = get_field('fil_ariane_resultats_recherche', 'option'); ?>
	<div class="breadcrumb_container">

		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'><?php echo $fil_ariane_resultats_recherche; ?></span></p>
		</nav>
	</div>
<?php endif; ?>


<!-- Page 404 -->
<?php
if (is_404()) : ?>
	<div class="breadcrumb_container">
		<nav class="breadcrumb_top content_width">
			<p class="legende"><a href="<?php bloginfo('url'); ?>"><?php echo $fil_ariane_accueil; ?></a><span class="breadcrumb_separator">›</span><span aria-current='location'>404</span></p>
		</nav>
	</div>
<?php endif; ?>