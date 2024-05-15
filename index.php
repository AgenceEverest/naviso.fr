<?php get_header(); ?>
<?php get_template_part('inc/header/header-main'); ?>
<?php get_template_part('inc/breadcrumb'); ?>

<?php the_post(); ?>
<?php $term = get_queried_object(); ?>
<div id="global_content">
    <section class="page_les_actualites">
        <article id="post-container-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part('inc/header/header-page'); ?>
            <?php   $thumbnail = get_post_thumbnail_id(get_queried_object_id());
                    $size_thumbnail = "large";
                    $url_thumbnail = $thumbnail ? wp_get_attachment_image_url($thumbnail, $size_thumbnail) : null;
                    $image_weight = $url_thumbnail ? apply_filters('get_weight_of_img', $url_thumbnail) : '0kb' ?>
            <?php $description_extrait_de_la_page = get_field("description_extrait_de_la_page", get_queried_object_id()); ?>
            <div class=" fond_clair2 padding_section_bottom block block-2-colonnes-textevisuel-large ">
                <div class="col_double_wide_imgleft flex-dir-row-reverse  visuel-en-haut-format-mobile ">
                    <div class="col_left_wide_imgleft">
                        <div class="hauteur-fixe-visuel-large col_left_wide_imgleft_img">
                            <figure class=" border-top-left-radius  border-bottom-left-radius ">
                                <div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>
                                    <?php $post_thumbnail_header = wp_get_attachment_image_src($thumbnail, $size_thumbnail);
                                    $alt_text = get_post_meta($thumbnail, '_wp_attachment_image_alt', true); ?>
                                    <?php if ($post_thumbnail_header) : ?>
                                        <img src="<?php echo $post_thumbnail_header[0]; ?>" width="<?php echo $post_thumbnail_header[1]; ?>" height="<?php echo $post_thumbnail_header[2]; ?>" alt="<?php echo $alt_text; ?>" loading="lazy">
                                    <?php endif; ?>
                            </figure>
                        </div>
                    </div>
                    <div class="col_right_wide_imgleft padding_section">
                        <div class="col_right_wide_imgleft_wrapper_custom entry-content">
                            <p style="padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
                                <?php echo $description_extrait_de_la_page; ?>  
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="padding_section">
                
                <div id="blog_top" class="content_width padding_section_bottom">
                    <?php
                        function TermTag($slug, $name){
                            echo '<li data-slug="'.$slug.'" class="term_tag_item is_filter">'.$name.'</li>'; 
                        }
                        function TermTagList($terms){
                            if (!empty($terms) && !is_wp_error($terms)) {
                                echo '<ul class="term_tag_list legende">';
                                    foreach ($terms as $term) {
                                        TermTag($term->slug, $term->name);
                                    }
                                echo '</ul>';
                            } 
                        }; ?>
                    <?php
                    // Vérifier si la fonction get_terms existe pour éviter des erreurs
                        if (function_exists('get_terms')) {
                            // Récupérer les termes de la taxonomie 'type_expertise'
                            $terms = get_terms(array(
                                'taxonomy' => 'category',
                                'hide_empty' => true, // N'afficher que les termes qui ont des posts associés
                            ));
                            TermTagList($terms);
                        }
                    ?>

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
                            'posts_per_page' => $default_posts_per_page,
                            'paged' => $paged
                        );
                        $custom_query = new WP_Query($args);
                    ?>
                    <?php
                        while ($custom_query->have_posts()) : $custom_query->the_post();
                            get_template_part('inc/extrait-article');
                        endwhile;
                        ?>
                </div>
                
                <?php display_pagination($custom_query); ?>

                <div id="load_more_wrapper" class="padding_section_top content_width">
                    <div class="cta_btn_lead">
                        <?php $charger_plus_d_articles = get_field("charger_plus_d_articles", "option"); ?>
                        <button id="load_more" class="load-more-btn"><?php echo $charger_plus_d_articles ? $charger_plus_d_articles : "Charger plus d'articles" ?></button>
                    </div>
                </div>
            </div>
            <div class="content_width padding_section_bottom">
                <?php $articles_par_categories = get_field("articles_par_categories", "option"); ?>
                <p><?php echo $articles_par_categories ? $articles_par_categories : "Articles par catégories :" ?></p>
                <ul class="term_tag_list legende"> 
                    <?php 
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC',
                            'hide_empty' => true, // Cache les catégories sans articles
                        ));
                        foreach ($categories as $category) {
                            if ($category->count > 0) { // Vérifie si la catégorie contient des articles
                                echo '<li class="term_tag_item has_number"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '<span class="term_tag_item_number">'. $category->count .'</span></a></li>';
                            }
                        }
                    ?>
                </ul>
            </div>
        </article>
    </section>
    <?php get_footer(); ?>
</div> <!-- #global_content -->