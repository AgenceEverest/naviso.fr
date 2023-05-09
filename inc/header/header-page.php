<header class="entry_title padding_section bandeau-header-page">
	<div class="content_width">
		<?php if(is_search()){ ?>
			<?php $rechercher_sur_le_site_resultats = get_field('rechercher_sur_le_site_resultats', 'option'); ?>
			<h1><?php echo $rechercher_sur_le_site_resultats; ?> <?php printf( __( '%s', 'shape' ), '<strong>' . get_search_query() . '</strong>' ); ?></h1>
		<?php } elseif (is_home()) { ?>
			<?php $titresdelapageactualites = get_field('titre_de_la_page_actualites', 'option'); ?>
            <h1><?php echo "$titresdelapageactualites" ?></h1>
		<?php } elseif (is_category()) { ?>
			<?php $term = get_queried_object(); ?>
            <h1><?php echo "$term->name" ?></h1>
		<?php } elseif (is_404()) { ?>
			<h1>Cette page n'existe pas.</h1>
		<?php } else{ ?>
			<h1><?php the_title(); ?></h1>
		<?php } ?>
	</div>
</header>