<?php $ajouter_une_bordure = get_sub_field('ajouter_une_bordure');
$ajouter_un_call_to_action = get_sub_field('ajouter_un_call-to-action');
$ajouter_un_deuxieme_call_to_action = get_sub_field('ajouter_un_deuxieme_call-to-action');
$position_du_bouton = get_sub_field('position_du_bouton');
$texte = get_sub_field('texte');
$ajouter_une_icone = get_sub_field('ajouter_une_icone');
$size_ajouter_une_icone = 'icones-colonnes';
$url_ajouter_une_icone = $ajouter_une_icone ? wp_get_attachment_image_url($ajouter_une_icone, $size_ajouter_une_icone) : null;
$image_weight = $url_ajouter_une_icone ? apply_filters('get_weight_of_img', $url_ajouter_une_icone) : '0kb'; ?>

<div class="col_flexible_item<?php if ($ajouter_une_icone) : ?> col_flexible_icone<?php endif; ?><?php if ($position_du_bouton == 'bouton_bas_colonne' && $ajouter_un_call_to_action) : ?> col_flexible_cta<?php endif; ?><?php if ($ajouter_une_bordure) : ?> col_flexible_bordure<?php endif; ?><?php if (!$ajouter_une_bordure) : ?> col_flexible_sansbordure<?php endif; ?>">
    <?php if ($ajouter_une_icone) : ?>
        <figure class="figure_col_flex_icone">
            <div class="poids-image-picto-container">
                <div class="poids-image-picto"><?= $image_weight ?></div>
            </div>
            <?php echo wp_get_attachment_image($ajouter_une_icone, $size_ajouter_une_icone, "", ["class" => "col_flexible_icone_img"]); ?>
        </figure>
    <?php endif; ?>
    <div class="entry-content">
        <?php echo $texte; ?>
        <?php if ($ajouter_un_call_to_action && $position_du_bouton == 'bouton_sous_texte') : ?>
            <div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
                                        endif; ?>">
                <?php if (have_rows('call-to-action')) : ?>
                    <?php while (have_rows('call-to-action')) : the_row(); ?>
                    <?php get_template_part('inc/content-builder-inc/cta-col'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if (have_rows('call-to-action_2')  && $ajouter_un_deuxieme_call_to_action) : ?>
                    <?php while (have_rows('call-to-action_2')) : the_row(); ?>
                    <?php get_template_part('inc/content-builder-inc/cta-col'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($ajouter_un_call_to_action && $position_du_bouton == 'bouton_bas_colonne') : ?>
        <div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
                                    endif; ?>">
            <?php if (have_rows('call-to-action')) : ?>
                <?php while (have_rows('call-to-action')) : the_row(); ?>
                <?php get_template_part('inc/content-builder-inc/cta-col'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if (have_rows('call-to-action_2') && $ajouter_un_deuxieme_call_to_action) : ?>
                <?php while (have_rows('call-to-action_2')) : the_row(); ?>
                <?php get_template_part('inc/content-builder-inc/cta-col'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>