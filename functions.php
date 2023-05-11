<?php
function styles2_css()
{
    // Chargement du style.css pour le thème enfant.
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array('parenthandle')
    );
    // Chargement de mainchild.css pour le thème enfant.
    wp_enqueue_style('mainchild', get_stylesheet_directory_uri() . '/css/mainchild.css', array(), filemtime(get_stylesheet_directory() . '/css/mainchild.css'), false);
}

//la priorité à 99, c'est pour que main2.css soit chargé après main.css, de cette manière les règles CSS du thème enfant peuvent écraser celles du thème parent.
add_action('wp_enqueue_scripts', 'styles2_css', 99);

/**
 * Si vous avez besoin d'ajouter des blocs ACF dans le thème enfant d'un site, il faut les ajouter ici, il su
 */
add_action('acf/init', 'my_acf_init_child');
function my_acf_init_child()
{
    // check function exists
    if (function_exists('acf_register_block')) {
        // register block test
         acf_register_block(array(
            'name'                => 'block-selection-clients',
            'title'                => __('Bloc sélection de cas clients'),
            'description'        => __('Un bloc permettant de sélectionner des cas clients.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'edit', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        )); 
        acf_register_block(array(
            'name'                => 'block-contacter-expert-logiciel',
            'title'                => __('Bloc contacter un expert logiciel'),
            'description'        => __('Un bloc avec un bouton de contact.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'edit', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        )); 
        acf_register_block(array(
            'name'                => 'block-listant-les-metiers',
            'title'                => __('Bloc listant les métiers'),
            'description'        => __('Un bloc listant les métiers.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'edit', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-newsletter',
            'title'                => __('Bloc newsletter'),
            'description'        => __('Un bloc pour la newsletter.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'edit', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-app',
            'title'                => __('Bloc app VueJs'),
            'description'        => __('Un bloc contenant une app VueJS pour filtrer les posts.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'edit', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        )); 
        acf_register_block(array(
            'name'                => 'block-trois-derniers-webinaires',
            'title'                => __('Bloc 3 derniers webinaires'),
            'description'        => __('Un bloc listant les trois derniers webinaires.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'edit', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        )); 

        
    }
}
function block_callback_child($block)
{
    // convert name ("acf/bloc-name") into path friendly slug ("bloc-name")
    $slug = str_replace('acf/', '', $block['name']);
    // include a template part from within the "template-parts/blocks" folder
    if (file_exists(get_theme_file_path("/inc/blocks/{$slug}.php"))) {
        include(get_theme_file_path("/inc/blocks/{$slug}.php"));
    }
}

// filtre les blocs : seuls les blocs déclarés par cette fonction seront affichés 
// Il faut rajouter le bloc de notre thème enfant dans cette liste 
function my_plugin_allowed_block_types_child($allowed_block_types_all, $post)
{
    return array('core/paragraph', 'acf/block-separateur', 'acf/block-2-colonnes-textevisuel', 'acf/block-2-colonnes-textevisuel-large', 'acf/block-multicolonnes', 'acf/block-2-colonnes', 'acf/block-3-colonnes', 'acf/block-1-colonne', 'acf/block-ancres', 'acf/block-cpt-list-filterable', 'acf/block-liste-de-termes', 'acf/block-2-colonnes-superposition', 'acf/block-selection-clients', 'acf/block-contacter-expert-logiciel', 'acf/block-listant-les-metiers', 'acf/block-more-informations', 'acf/block-newsletter', 'acf/block-app', 'acf/block-trois-derniers-webinaires');
}
add_filter('allowed_block_types_all', 'my_plugin_allowed_block_types_child', 11, 3);

function showSvg($url)
{
    $response = wp_remote_get($url);
    if (is_array($response) && !is_wp_error($response)) {
        $svg    = $response['body']; // use the content
    }
    return $svg;
}

function register_custom_menus() {
    register_nav_menus(
        array(
            'menu-footer-2' => __( 'Menu Footer 2' ),
        )
    );
}
add_action( 'after_setup_theme', 'register_custom_menus' );


function borderRound($arrondir_les_bords_de_limage ) {
    $class1 = '';
    $class2 = '';
    $class3 = '';
    $class4 = '';

    foreach ($arrondir_les_bords_de_limage as $value) {
        switch ($value) {
            case 'haut_gauche':
                $class1 = ' border-top-left-radius ';
                break;
            case 'haut_droit':
                $class2 = ' border-top-right-radius ';
                break;
            case 'bas_gauche':
                $class3 = ' border-bottom-left-radius ';
                break;
            case 'bas_droit':
                $class4 = ' border-bottom-right-radius ';
                default: 
                break;
        }
    }
    return $class1 . $class2 . $class3 . $class4;
}

