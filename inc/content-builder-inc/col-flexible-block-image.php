<div class="col_flexible_item">
    <?php
    $image_col_flexible = get_sub_field('image_col_flexible');
    $size_image_col_flexible = 'medium large';
    $image_col_flexible_url = wp_get_attachment_image_url($image_col_flexible, $size_image_col_flexible);
    $image_weight = apply_filters('get_weight_of_img', $image_col_flexible_url);

    $ajouter_un_copyright = get_sub_field('ajouter_un_copyright');
    $adapter_a_la_hauteur_des_colonnes = get_sub_field('adapter_a_la_hauteur_des_colonnes');
    $ajouter_une_legende = get_sub_field('ajouter_une_legende');
    $proportions_de_limage = get_sub_field('proportions_de_limage');
    $ajouter_un_lien_sur_limage = get_sub_field('ajouter_un_lien_sur_limage');
    $lien_interne_image = get_sub_field('lien_interne_image');
    $lien_externe_image = get_sub_field('lien_externe_image');

    $classBorderRound = '';
    $arrondir_les_bords_de_limage = get_sub_field('arrondir_les_bords_de_limage');
    if ($arrondir_les_bords_de_limage) {
        $classBorderRound = borderRound($arrondir_les_bords_de_limage);
    }

    ?>
    <div class="col_flexible_image">
        <div class="col_flexible_image_wrapper <?php echo $proportions_de_limage; ?> <?php if ($adapter_a_la_hauteur_des_colonnes) : ?>adapter_a_la_hauteur_des_colonnes<?php endif; ?><?php if (!$adapter_a_la_hauteur_des_colonnes) : ?>pas_adapter_a_la_hauteur_des_colonnes<?php endif; ?>">
            <figure class="<?= $classBorderRound ?>">
                <div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>

                <?php if ($ajouter_un_lien_sur_limage == "lien_interne_sur_limage") : ?><a href="<?php echo $lien_interne_image; ?>"><?php endif; ?>
                    <?php if ($ajouter_un_lien_sur_limage == "lien_externe_sur_limage") : ?><a href="<?php echo $lien_externe_image; ?>" target="_blank"><?php endif; ?>

                        <?php if ($adapter_a_la_hauteur_des_colonnes) : ?>
                            <?php echo wp_get_attachment_image($image_col_flexible, $size_image_col_flexible, "", ["class" => "image_simple_recadree"]); ?>
                        <?php else : ?>
                            <?php echo wp_get_attachment_image($image_col_flexible, $size_image_col_flexible, ""); ?>
                        <?php endif; ?>

                        <?php if ($ajouter_un_lien_sur_limage == "lien_interne_sur_limage") : ?></a><?php endif; ?>
                    <?php if ($ajouter_un_lien_sur_limage == "lien_externe_sur_limage") : ?></a><?php endif; ?>

                <?php if ($ajouter_un_copyright) : ?>
                    <p class="copyright_image"><span class="copyright_image_txt">© <?php echo $ajouter_un_copyright; ?></span><span class="copyright_image_bg"></span></p>
                <?php endif; ?>
            </figure>
            <?php if ($ajouter_une_legende) : ?><p class="ajouter_une_legende legende"><?php echo $ajouter_une_legende; ?></p><?php endif; ?>
        </div>
    </div>
</div>