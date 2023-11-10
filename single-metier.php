<?php get_header(); ?>
<?php get_template_part('inc/header/header-main'); ?>
<?php get_template_part('inc/breadcrumb'); ?>
<?php the_post(); ?>
<div id="global_content">
	<section class="page_defaut article_blog">
		<article id="post-container-<?php the_ID(); ?>" <?php post_class(); ?>>
			
		<header class="entry_title padding_section">
					<h1><?= showSvg(get_stylesheet_directory_uri() . '/svg/naviso-h1-logiciel')?><?= the_title() ?></h1>
			</header>

			<?php if (the_content()) :
				the_content();
			endif; ?>


		</article>
		<?php get_template_part('inc/aside-actualites'); ?>
	</section>
	<?php get_footer(); ?>
</div> <!-- #global_content -->