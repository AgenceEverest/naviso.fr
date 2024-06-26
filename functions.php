<?php
function styles2_css()
{
    // Chargement du style.css pour le thème enfant.
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array('parenthandle')
    );
    wp_enqueue_script('main-child', get_stylesheet_directory_uri() . '/js/main-child.js', array(), filemtime(get_stylesheet_directory() . '/js/main-child.js'), true);

    // Chargement de mainchild.css pour le thème enfant.
    wp_enqueue_style('mainchild', get_stylesheet_directory_uri() . '/css/mainchild.css', array(), filemtime(get_stylesheet_directory() . '/css/mainchild.css'), false);
}

//la priorité à 99, c'est pour que main2.css soit chargé après main.css, de cette manière les règles CSS du thème enfant peuvent écraser celles du thème parent.
add_action('wp_enqueue_scripts', 'styles2_css', 99);



// Add a defer attribute to main-child script
function add_defer_attribute_to_script_child($tag, $handle, $src) {
    // Vérifie si le handle du script est celui que vous voulez modifier
    if ('main-child' === $handle) {
        // Ajoute l'attribut defer à la balise script
        $tag = '<script src="' . esc_url($src) . '" defer="defer"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute_to_script_child', 10, 3);



// Désenregistrer ArkFilter
function arkfilter_deregister_scripts() {
    wp_dequeue_script('ark_filter');
    wp_deregister_script('ark_filter');
}
add_action('wp_enqueue_scripts', 'arkfilter_deregister_scripts', 100);


// on désactive l'import des champs ACF (Ils ne sont plus importés depuis le thème, mais depuis ACF lui même)
define('DISABLE_ACF_CUSTOMISATION_NANOSITE', true);
define('DISABLE_ACF_CLONABLE_COLONNE_FLEXIBLE', true);
define('DISABLE_ACF_CLONABLE_BLOCK_OPTIONS', true);
define('DISABLE_ACF_BLOCK_1_COLONNE', true);
define('DISABLE_ACF_BLOCK_2_COLONNES', true);
define('DISABLE_ACF_BLOCK_3_COLONNES', true);
define('DISABLE_ACF_BLOCK_2_COLONNES_TEXTEVISUEL', true);
define('DISABLE_ACF_BLOCK_2_COLONNES_TEXTEVISUEL_LARGE', true);
define('DISABLE_ACF_BLOCK_MULTICOLONNES', true);
define('DISABLE_ACF_BLOCK_LISTE_POSTS', true);
define('DISABLE_ACF_BLOCK_TEXT_CTA', true);
define('DISABLE_ACF_BLOCK_CHIFFRES_CLES', true);
define('DISABLE_ACF_BLOCK_ANCRES_V2', true);
define('DISABLE_ACF_CLONABLE_COLONNES_FLEXIBLES', true);
define('DISABLE_ACF_CLONABLE_OPTIONS', true);

/**
 * Si vous avez besoin d'ajouter des blocs ACF dans le thème enfant d'un site, il faut les ajouter ici, il su
 */
add_action('acf/init', 'my_acf_init_child');
function my_acf_init_child()
{
    // check function exists
    if (function_exists('acf_register_block')) {

        // register block filtre
		acf_register_block(array(
			'name'				=> 'block-cpt-list-filterable',
			'title'				=> __('Bloc listant les articles customisés filtrables'),
			'description'		=> __('Un bloc montrant un filtre.'),
			'render_callback'	=> 'block_callback',
			'category'			=> 'layout',
			'icon'				=> 'image-flip-vertical',
			'mode'				=> 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
		));
        acf_register_block(array(
            'name'                => 'block-2-colonnes-superposition',
            'title'                => __('Bloc 2 colonnes avec superposition de contenu'),
            'description'        => __('Un bloc pour le theme enfant.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-selection-clients',
            'title'                => __('Bloc sélection de cas clients'),
            'description'        => __('Un bloc permettant de sélectionner des cas clients.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-contacter-expert-logiciel',
            'title'                => __('Bloc contacter un expert logiciel'),
            'description'        => __('Un bloc avec un bouton de contact.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-listant-les-metiers',
            'title'                => __('Bloc listant les métiers'),
            'description'        => __('Un bloc listant les métiers.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-newsletter',
            'title'                => __('Bloc newsletter'),
            'description'        => __('Un bloc pour la newsletter.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-app',
            'title'                => __('Bloc app VueJs'),
            'description'        => __('Un bloc contenant une app VueJS pour filtrer les posts.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
        ));
        acf_register_block(array(
            'name'                => 'block-trois-derniers-webinaires',
            'title'                => __('Bloc 3 derniers webinaires'),
            'description'        => __('Un bloc listant les trois derniers webinaires.'),
            'render_callback'    => 'block_callback_child',
            'category'            => 'layout',
            'icon'                => 'image-flip-vertical',
            'mode'                => 'auto', // permet d'ouvrir le bloc immédiatement, l'autre mode est "preview"
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
        $svg = $response['body']; // use the content
    }
    return $svg;
}

function register_custom_menus()
{
    register_nav_menus(
        array(
            'menu-footer-2' => __('Menu Footer 2'),
        )
    );
}
add_action('after_setup_theme', 'register_custom_menus');


function borderRound($arrondir_les_bords_de_limage)
{
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



if (!function_exists('acf_load_post_types_child')) {
    function acf_load_post_types_child($field)
    {
        $field['choices'] = array();
        $args = array(
            'public'   => true,
        );
        foreach (get_post_types($args, 'objects') as $post_type) {
            $field['choices'][$post_type->name] = $post_type->label;
        }
        return $field;
    }

    add_filter('acf/load_field/name=publication_liste_app_child', 'acf_load_post_types_child', 20);
    add_filter('acf/load_field/name=publication_choisie_child', 'acf_load_post_types_child', 20);
}



if (!function_exists('acf_load_icons')) {
    function acf_load_icons($field)
    {
        $theme = wp_get_theme();
        $chemin_dossier = $theme->get_stylesheet_directory() . '/img/icons';
        $fichiers = glob($chemin_dossier . '/*');
        foreach ($fichiers as $fichier) {
            // Création de la structure de données pour le champ ACF
            $valeur = [
                'nom_fichier' => basename($fichier),
                'chemin_fichier' => $fichier
            ];

            $field['choices'][$valeur['chemin_fichier']] = $valeur['nom_fichier'];
        } 
        return $field;

    }
    add_filter('acf/load_field/name=icone_svg', 'acf_load_icons', 20);
}

// add Hubspot tracking in <head>
function add_Hubspot_tracking() {
    ?>
    <script type="text/javascript" id="hs-script-loader" async defer src="https://js-eu1.hs-scripts.com/25676509.js"></script>
    <?php
}
add_action('wp_head', 'add_Hubspot_tracking');



include(get_stylesheet_directory() . '/functions/exclude-from-xml-sitemap.php');
include(get_stylesheet_directory() . '/functions/structured-data-for-breadcrumb-child.php');