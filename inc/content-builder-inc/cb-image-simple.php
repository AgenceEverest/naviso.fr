<?php
$cb_image_simple = get_sub_field('cb_image_simple_image');
$size_cb_image_simple = 'medium';
$url_cb_image_simple = $cb_image_simple ? wp_get_attachment_image_url($cb_image_simple, $size_cb_image_simple) : null;
$image_weight = $url_cb_image_simple ? apply_filters('get_weight_of_img', $url_cb_image_simple) : '0kb';
$image_simple_copyright = get_sub_field('cb_image_simple_image_copyright');
$ajouter_une_legende = get_sub_field('cb_image_simple_image_legende');
$hauteur_fixe_visuel = get_sub_field('hauteur_fixe_visuel');

$classBorderRound = '';
$arrondir_les_bords_de_limage = get_sub_field('arrondir_les_bords_de_limage');
if ($arrondir_les_bords_de_limage) {
	$classBorderRound = borderRound($arrondir_les_bords_de_limage);
}
?>
<div class="image_simple_wrapper <?= $hauteur_fixe_visuel ? 'hauteur-fixe-visuel' : '' ?>">
	<?php if ($image_simple_copyright) : ?>
		<p class="copyright_image "><span class="copyright_image_txt"><?php echo $image_simple_copyright; ?></span><span class="copyright_image_bg"></span></p>
	<?php endif; ?>
	<figure class="image_simple <?= $classBorderRound  ?>">
		<div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>
		<?php $image_simple = wp_get_attachment_image_src($cb_image_simple, $size_cb_image_simple);

		$alt_text = get_post_meta($cb_image_simple, '_wp_attachment_image_alt', true); ?>
		<img src="<?php echo $image_simple[0]; ?>" class="image_simple_recadree" width="<?php echo $image_simple[1]; ?>" height="<?php echo $image_simple[2]; ?>" alt="<?php echo $alt_text; ?>" loading="lazy">
	</figure>
	<?php if ($ajouter_une_legende) : ?><p class="ajouter_une_legende legende"><?php echo $ajouter_une_legende; ?></p><?php endif; ?>
</div>