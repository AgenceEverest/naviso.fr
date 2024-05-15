<?php get_header(); ?>
<?php get_template_part('inc/header/header-main'); ?>
<?php get_template_part('inc/breadcrumb'); ?>
<?php the_post(); ?>
<?php $term = get_queried_object(); ?>

<div id="global_content">
    <section class="page_les_actualites">
        <article id="post-container-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part('inc/header/header-page'); ?>
            <div class="padding_section">
                <div id="blog_top" class="content_width padding_section_bottom">
                    <?php $page_for_posts = get_permalink(get_option('page_for_posts')); 
                        $retour_au_blog = get_field("retour_au_blog", "option");
                    ?>
                    <p class="cta_btn_lead"><a href="<?php echo $page_for_posts; ?>"><?php echo $retour_au_blog ? $retour_au_blog : "Retour au blog" ?></a></p>
                    <div id="charger_les_images_wrapper" style="display:none;">
                        <p class="legende">
                            <div id="charger_les_images_switch">
                                <?php $charger_les_images = get_field('charger_les_images', 'option'); ?>
                                <label tabindex="0" for="f" id="charger_les_images"><?php if($charger_les_images): ?><?php echo $charger_les_images; ?><?php endif; ?></label>
                                <label tabindex="-1" id="charger_les_images_switch_label" class="switch">
                                    <input tabindex="-1" name="charger_les_images_switch" id="f" type="checkbox">
                                    <span tabindex="-1" aria-label="charger les images" class="slider round"></span>
                                </label>
                            </div>
                        </p>
                    </div>
                </div>
                <div id="articles_wrapper_blog" class="articles_wrapper content_width">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $default_posts_per_page = get_option('posts_per_page');
                    $args = array(
                        'post_type'     => 'post',
                        'post_status'   => 'publish',
                        'category_name' => $term->slug,
                        'posts_per_page' => $default_posts_per_page,
                        'paged' => $paged,
                    );
                    $custom_query = new WP_Query($args);
                    ?>
                    <?php
                    while ($custom_query->have_posts()) :
                        $custom_query->the_post();
                    ?>
                        <?php get_template_part('inc/extrait-article'); ?>
                    <?php endwhile; ?>
                </div>
                <?php display_pagination($custom_query); ?>
            </div>
        </article>
    </section>
    <?php get_footer(); ?>
</div> <!-- #global_content -->