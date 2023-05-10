<?php

/**
 * Block Name: block-cpt-list-filterable
 *
 * Montre une liste de CPT avec la possibilité de les filtrer
 */
if (have_rows('block_listant_les_metiers')) : the_row();
	// CSS
	$cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
	$ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
	$couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
    $marge_externe_en_haut_du_bloc = get_sub_field('marge_externe_en_haut_du_bloc');
    $marge_externe_en_bas_du_bloc = get_sub_field('marge_externe_en_bas_du_bloc');
    $marge_interne_en_haut_du_bloc = get_sub_field('marge_interne_en_haut_du_bloc');
    $marge_interne_en_bas_du_bloc = get_sub_field('marge_interne_en_bas_du_bloc');
	$nombre_articles_liste = get_sub_field('nombre_articles_liste');
	$type_extrait = get_sub_field('type_extrait');
endif; ?>
<div <?php if ($ajouter_un_id_pour_le_css) : echo "id='" . $ajouter_un_id_pour_le_css . "' ";
		endif;
		echo 'class= "';
		if ($cb_ajouter_une_classe_css) : echo $cb_ajouter_une_classe_css . ' ';
		endif;
        if ($marge_interne_en_haut_du_bloc) :
            echo " padding_section_top";
        endif;
        if ($marge_interne_en_bas_du_bloc) :
            echo " padding_section_bottom";
        endif;
        if ($marge_externe_en_haut_du_bloc) :
            echo " margin_section_top";
        endif;
        if ($marge_externe_en_bas_du_bloc) :
            echo " margin_section_bottom";
        endif;
		if ($couleur_de_fond_bloc) : echo $couleur_de_fond_bloc;
		endif;
		echo ' block"' ?>>
	<?php $the_query = new WP_Query(array(
		'post_type' => 'metier',
		'posts_per_page' => $nombre_articles_liste,
		'order'     => 'DESC',
		'post_status'       => 'publish',
	));
	?>
	<div id="result" class="padding_section">
		<div id="liste_resultats" class="content_width">
			<?php while ($the_query->have_posts()) : $the_query->the_post();
				get_template_part('inc/extrait-metier');
			endwhile; ?>
		</div>
	</div>

	<?php
	wp_reset_query();
	?>

</div>