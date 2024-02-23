<?php get_template_part('inc/pre-footer'); ?>

<?php $activer_le_bandeau_de_cookies_v2 = get_field('activer_le_bandeau_de_cookies_v2', 'option'); ?>
<?php $masquer_cookies = get_field('masquer_cookies', 'option'); ?>
<?php if ($activer_le_bandeau_de_cookies_v2 && $masquer_cookies === 'invisible') : ?>
    <?php include(get_template_directory() . '/inc/content-builder-inc/cookie-banner-V2.php'); ?>
<?php endif;
if ($masquer_cookies === 'visible' && !$activer_le_bandeau_de_cookies_v2) : ?>
    <?php include(get_template_directory() . '/inc/content-builder-inc/cookie-banner-V1.php'); ?>
<?php endif; ?>



<?php $copyright_text = get_field('copyright_text', 'option') ?>
<footer id="footer">
    <div id="footer_wrapper" class="content_width">
        <p id="footer_content" class="legende">
            <span>
                <?php $signature_footer = get_field('signature_footer', 'option'); ?>
                © <?php echo date("Y") ?> <?php bloginfo('name'); ?> -
                <?= $copyright_text ?>
            </span>
            <span id="menu-footer">
                <?php $menuParameters = array(
                    'theme_location'  => 'menu-footer',
                    'container'       => false,
                    'echo'            => false,
                    'items_wrap'      => '%3$s',
                    'depth'           => 0,
                );
                echo strip_tags(wp_nav_menu($menuParameters), '<a>'); ?>

                <?php $page_facebook = get_field('page_facebook', 'option'); ?>
                <?php $page_twitter = get_field('page_twitter', 'option'); ?>
                <?php $page_linkedin = get_field('page_linkedin', 'option'); ?>
                <?php $page_instagram = get_field('page_instagram', 'option'); ?>
                <?php $page_youtube = get_field('page_youtube', 'option'); ?>
                <?php $reseaux_sociaux_suivez_nous_sur = get_field('reseaux_sociaux_suivez-nous_sur', 'option'); ?>
                <span class="rs_link_wrapper">
                    <?php if ($page_facebook) : ?>
                        <a target="_blank" href="<?php echo $page_facebook; ?>" class="rs_link_item" title="<?php if ($reseaux_sociaux_suivez_nous_sur) : ?>
                        <?php echo $reseaux_sociaux_suivez_nous_sur; ?>
                        <?php endif; ?> Facebook">
                            <?= showSvg(get_stylesheet_directory_uri() . '/svg/facebook.svg') ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($page_twitter) : ?><a target="_blank" href="<?php echo $page_twitter; ?>" class="rs_link_item" title="<?php if ($reseaux_sociaux_suivez_nous_sur) : ?>
                    <?php echo $reseaux_sociaux_suivez_nous_sur; ?>
                    <?php endif; ?> Twitter">
                            <?= showSvg(get_stylesheet_directory_uri() . '/svg/twitter.svg') ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($page_linkedin) : ?><a target="_blank" href="<?php echo $page_linkedin; ?>" class="rs_link_item" title="<?php if ($reseaux_sociaux_suivez_nous_sur) : ?>
                    <?php echo $reseaux_sociaux_suivez_nous_sur; ?>
                    <?php endif; ?> Linkedin">
                            <?= showSvg(get_stylesheet_directory_uri() . '/svg/linkedin.svg') ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($page_instagram) : ?><a target="_blank" href="<?php echo $page_instagram; ?>" class="rs_link_item" title="<?php if ($reseaux_sociaux_suivez_nous_sur) : ?>
                    <?php echo $reseaux_sociaux_suivez_nous_sur; ?>
                    <?php endif; ?> Instagram">
                            <?= showSvg(get_stylesheet_directory_uri() . '/svg/instagram.svg') ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($page_youtube) : ?><a target="_blank" href="<?php echo $page_youtube; ?>" class="rs_link_item" title="<?php if ($reseaux_sociaux_suivez_nous_sur) : ?>
                    <?php echo $reseaux_sociaux_suivez_nous_sur; ?>
                    <?php endif; ?> Youtube">
                            <?= showSvg(get_stylesheet_directory_uri() . '/svg/youtube.svg') ?>
                        </a>
                    <?php endif; ?>
                </span>
            </span>
        </p>
    </div>
    <div id="retourenhaut">
        <svg id="retourenhaut_svg" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
            <rect class="cls-1" width="40" height="40" />
            <circle id="circle_base" class="cls-2" cx="20" cy="20" r="18" />
            <g>
                <line class="cls-3" x1="20" y1="30.67" x2="20" y2="10.67" />
                <polyline class="cls-3" points="12.46 18.21 20 10.67 27.54 18.21" />
            </g>
            <circle id="circle_progress" class="cls-3" cx="20" cy="20" r="18" transform="rotate(-90 20 20)" />
        </svg>
    </div>

    <?php get_template_part('inc/nanosite-label'); ?>

</footer>
<div class="wrapper_prefooter_footer_svg"></div>

<?php get_template_part('inc/css-compil-footer') ?>
<?php
$duree_reapparition_bandeau = 5;
$nom_du_cookie = get_field('nom_du_cookie', 'option');
$duree_du_cookies = 14;
?>

<script>
    let cookieName = '<?= htmlspecialchars($nom_du_cookie) ?>';
    let cookieDuration = '<?= htmlspecialchars($duree_du_cookies) ?>';
    let durationRefused = '<?= htmlspecialchars($duree_reapparition_bandeau) ?>';
</script>
<?php wp_footer(); ?>