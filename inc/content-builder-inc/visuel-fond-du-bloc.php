<?php $choix_du_visuel = get_sub_field('choix_du_visuel_en_fond_de_bloc');
$position_vague_milieu = get_sub_field('position_de_la_vague');
$classe_vague = '';
$svg = '';
$position = '';
switch ($choix_du_visuel):
    case 'pas_de_visuel':
        $svg = '';
        $position = '';
    break;
    case 'deux_formes_boucle':
        $svg = showSvg(get_stylesheet_directory_uri() . '/svg/double-boucle.svg');
        $position = 'double-boucle';
    break; 
    case 'logo_naviso_triple_milieu_droit':
        $svg = showSvg(get_stylesheet_directory_uri() . '/svg/element-visuel-deux-col.svg');
        $position = 'milieu-droit';
        break; 
    case 'logo_naviso_triple_bas_droit':
        $svg = showSvg(get_stylesheet_directory_uri() . '/svg/element-visuel-deux-col.svg');
        $position = 'bas-droit';
        break; 
    case 'grande_vague_milieu':
        $svg = showSvg(get_stylesheet_directory_uri() . '/svg/grande-vague-milieu.svg');
        $position = 'vague-milieu';
        $classe_vague = $position_vague_milieu;
        break; 
    default: 
    break;
endswitch; ?>
<div class="svg-container <?= $position . ' ' . $classe_vague ?>">
    <?= $svg ?>
</div>
