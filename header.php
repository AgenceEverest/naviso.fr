<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="google-site-verification" content="XajfoLkgNR2N-oQyt2pO5cHrDvjPJfT6pSta25-1OLU" />
    <!-- favicon -->
    <?php $favicon = get_field('favicon', 'option'); ?>
    <?php if ($favicon) : ?>
        <link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>" />
    <?php endif;
    $cookieNameToCheck = get_field('nom_du_cookie', 'option');
    if (isset($_COOKIE[$cookieNameToCheck])) {
        if ($_COOKIE[$cookieNameToCheck] == 'accepted') {
            if (isset($_COOKIE['googleAnalyticsCookie'])) {
                if (($_COOKIE['googleAnalyticsCookie']) == 'accepted') {
                    $google_analytics = get_field('google_analytics', 'option');
                    if ($google_analytics) {
                        echo $google_analytics;
                    }
                }
            }

            if (isset($_COOKIE['facebookCookie'])) {
                if (($_COOKIE['facebookCookie']) == 'accepted') {
                    $facebook_pixel = get_field('pixel_facebook', 'option');
                    if ($facebook_pixel) {
                        echo $facebook_pixel;
                    }
                }
            }
        }
    }

    $tracking_matomo = get_field('tracking_matomo', 'option');
    if ($tracking_matomo) {
        echo $tracking_matomo;
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!--googleoff: index-->
    <a tabindex="0" href="#global_content" class="skip_to_global_content">Passer au contenu principal</a>
    <!--googleon: index -->

    <?php

    if (isset($_COOKIE[$cookieNameToCheck])) {
        if ($_COOKIE[$cookieNameToCheck] == 'accepted') {
            if (isset(($_COOKIE['googleAnalyticsCookie']))) {
                if (($_COOKIE['googleAnalyticsCookie']) == 'accepted') {
                    $google_analytics_noscript = get_field('google_analytics_noscript', 'option');
                    if ($google_analytics_noscript) {
                        echo $google_analytics_noscript;
                    }
                }
            }

            if ((isset($_COOKIE['googleAdsCookie']))) {
                if (($_COOKIE['googleAdsCookie']) == 'accepted') {
                    $google_ads = get_field('google_ads', 'option');
                    if ($google_ads) {
                        echo $google_ads;
                    }
                }
            }
        }
    } ?>


    <?php $multilingue_traductions = get_field('multilingue_traductions', 'option'); ?>
    <?php if ($multilingue_traductions) : ?>
        <div id="multilingue_wrapper_out_of_menu">
            <ul class="content_hide_menu content_hide_menu_search">&nbsp;
                <?php if (function_exists('pll_count_posts')) {
                    pll_the_languages(array('display_names_as' => 'slug'));
                } ?></ul>
        </div>
    <?php endif; ?>


    <header id="header" <?php if ($multilingue_traductions) : ?> class="multilingue_header" <?php endif; ?>>
        <div id="header_shadow"></div>
        <div id="branding">
            <div id="content_header" class="content_large">
                <a href="<?php bloginfo('url'); ?>" title="Retour à la page d'accueil">
                    <?php $importer_le_logo = get_field('importer_le_logo', 'option'); ?>
                    <?php $dimensions_logo = get_field('dimensions_logo', 'option'); ?>


                    <?php if (have_rows('dimensions_logo', 'option')) : ?>
                        <?php while (have_rows('dimensions_logo', 'option')) : the_row();  ?>
                            <?php $dimensions_logo_normal = get_sub_field('dimensions_logo_normal', 'option'); ?>
                            <?php $dimensions_logo_scroll = get_sub_field('dimensions_logo_scroll', 'option'); ?>

                            <script>
                                let dimensionsLogoNormal = <?php echo json_encode($dimensions_logo_normal); ?>;
                                let dimensionsLogoScroll = <?php echo json_encode($dimensions_logo_scroll); ?>;
                            </script>

                            <figure id="figure-logo-header">
                                <img src="<?php echo $importer_le_logo; ?>" alt="Logo <?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" id="logo_header_img">
                            </figure>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </a>
            </div>
        </div>