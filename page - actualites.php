<?php

/**
 * Template Name: Actualités
 */ ?>
 
<?php get_header(); ?>
<?php get_template_part('inc/header/header-main'); ?>
<?php get_template_part('inc/breadcrumb'); ?>
<?php the_post(); ?>
<div id="global_content">
	<section class="page_defaut">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php get_template_part('inc/header/header-page'); ?>
			<?php
			if (the_content()) :
				the_content();
			endif; ?>
		</article>
	</section>
	<?php get_footer(); ?>
</div> <!-- #global_content -->