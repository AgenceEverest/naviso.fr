<?php

/**
 * Block Name: block-cpt-list-filterable
 *
 * Montre une liste de CPT avec la possibilité de les filtrer
 */
if (have_rows('block_filtre')) : the_row();
	// CSS
	$cb_ajouter_une_classe_css = get_sub_field('cb_ajouter_une_classe_css');
	$ajouter_un_id_pour_le_css = get_sub_field('ajouter_un_id_pour_le_css');
	$couleur_de_fond_bloc = get_sub_field('couleur_de_fond_bloc');
    $marge_externe_en_haut_du_bloc = get_sub_field('marge_externe_en_haut_du_bloc');
    $marge_externe_en_bas_du_bloc = get_sub_field('marge_externe_en_bas_du_bloc');
    $marge_interne_en_haut_du_bloc = get_sub_field('marge_interne_en_haut_du_bloc');
    $marge_interne_en_bas_du_bloc = get_sub_field('marge_interne_en_bas_du_bloc');

	// Choix d'une publication / taxo / nombre de posts à afficher
	$publication_choisie = get_sub_field('publication_choisie');
	$choisir_une_taxonomie = get_sub_field('choisir_une_taxonomie');
	$taxonomie_choisie = get_sub_field('taxonomie_choisie');
	$numberOfPosts = get_sub_field('nombre_articles_liste');
	$typeExtrait = get_sub_field('type_extrait');
	$choisir_un_terme = get_sub_field('choisir_un_terme');
	$terme_choisi = get_sub_field('terme_choisi');


	// premier étage du filtre
	$afficher_le_filtre = get_sub_field('afficher_le_filtre');
	$taxonomie_choisie_premier_etage = get_sub_field('categorie_a_filtrer');
	$texte_tous_les_filtres = get_sub_field('texte_tous_les_filtres');
	$afficher_le_bouton_charger_plus = get_sub_field('afficher_le_bouton_charger_plus');

	// deuxième étage du filtre
	$afficher_le_sous_filtre = get_sub_field('afficher_le_sous_filtre');
	$taxonomie_choisie_deuxieme_etage = get_sub_field('categorie_a_sous_filtrer');
	$texte_tous_les_sous_filtres = get_sub_field('texte_tous_les_sous_filtres');

	$itemsByRowClass = 'three-items';

	if ($numberOfPosts) {
		switch ($numberOfPosts) {
			case 5:
				$itemsByRowClass = 'three-items';
				break;
			case 4:
				$itemsByRowClass = 'four-items';
				break;
			default:
				$itemsByRowClass = 'three-items';
				break;
		}
	}

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
		echo '"'; ?>>
	<?php if ($afficher_le_filtre) : ?>

		<!-- Premier étage de filtres -->
		<div class="filters-section padding_section_top" data-post-numbers="<?= $numberOfPosts  ?>" data-post-type="<?= $publication_choisie ?>" type-extrait="<?= $typeExtrait ?>">
			<div class="content_width">
				<p class="filtre_elements">
					<span class="filter-item-link filter-secteur-item filtre_element" data-category="default-filter"><span class="filtre_element_all"></span><?= $texte_tous_les_filtres ?></span>
					<?php $terms = get_terms(array(
						'taxonomy' => $taxonomie_choisie_premier_etage,
						'hide_empty' => false,  // passer sur “true” pour n'afficher que les terms qui sont assignés à des secteurs d'activités
					));
					foreach ($terms as $term) {
						$term_id = $term->term_id;
						$term_name = $term->name;
						$term_slug = $term->slug;
						echo "<span class='filtre_element filter-item-link filter' data-category=" . $term_slug . ">" . $term_name . "</span>";
					}
					?>
				</p>
			</div>
		</div>

		<!-- deuxième étage de filtres -->
		<?php if ($afficher_le_sous_filtre) : ?>
			<div class="filters-section sous_filtre" data-post-numbers="<?= $numberOfPosts  ?>" data-post-type="<?= $publication_choisie ?>">
				<div class="content_width">
					<p class="filtre_elements">
						<span class="filter-item-link filter-secteur-item filtre_element" data-category="default-sub-filter"><span class="filtre_element_all"></span><?= $texte_tous_les_sous_filtres ?></span>
						<?php $terms = get_terms(array(
							'taxonomy' => $taxonomie_choisie_deuxieme_etage,
							'hide_empty' => false,  // passer sur “true” pour n'afficher que les terms qui sont assignés à des secteurs d'activités
						));
						foreach ($terms as $term) {
							$term_id = $term->term_id;
							$term_name = $term->name;
							$term_slug = $term->slug;
							echo "<span class='filtre_element filter-item-link sub-filter' data-category=" . $term_slug . ">" . $term_name . "</span>";
						}
						?>
					</p>
				</div>
			</div>
		<?php endif; ?>
		<div id="result" class="padding_section">
			<!-- ici s'affichent les résultats chargés par le filtre -->
		</div>

	<?php else :
		$post_type = $publication_choisie;
		$terms = [];
		if ($taxonomie_choisie) {
			foreach (get_terms($taxonomie_choisie) as $term) {
				array_push($terms, $term->slug);
			};
		}

		// changer par ici au dessus : rajouter un seul term si on a choisi un seul term


		if ($choisir_une_taxonomie) {
			if ($choisir_un_terme) {
				$the_query = new WP_Query(array(
					'post_type'         => $post_type,
					'posts_per_page'    => $numberOfPosts,
					'order'             => 'DESC',
					'post_status'       => 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomie_choisie,
							'field'    => 'slug',
							'terms' => $terme_choisi,
						),
					),
				));
			} else {
				$the_query = new WP_Query(array(
					'post_type'         => $post_type,
					'posts_per_page'    => $numberOfPosts,
					'order'             => 'DESC',
					'post_status'       => 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomie_choisie,
							'field'    => 'slug',
							'terms' => $terms,
						),
					),
				));
			}
		} else {
			$the_query = new WP_Query(array(
				'post_type' => $post_type,
				'posts_per_page' => $numberOfPosts,
				'order'     => 'DESC',
				'post_status'       => 'publish',
			));
		} ?>
		<div id="result" class="padding_section block">
			<div id="liste_resultats" class="content_width <?= $itemsByRowClass ?>">
				<?php while ($the_query->have_posts()) : $the_query->the_post();
					if ($typeExtrait == 'extrait_simple') :
						get_template_part('inc/extrait-offre');
					elseif ($typeExtrait === 'extrait_avec_bandeau') :
						get_template_part('inc/extrait-avec-bandeau');
					elseif ($typeExtrait === 'extrait_metier') :
						get_template_part('inc/extrait-metier');
					elseif ($typeExtrait === 'extrait_formation') :
						get_template_part('inc/extrait-formation');
					endif;
				endwhile; ?>
			</div>
		</div>

		<?php

		$totalNumberOfPosts = intval(wp_count_posts($post_type)->publish);
		$post_number = $numberOfPosts;

		if ($post_number > ($totalNumberOfPosts + $post_number)) {
			$post_number = $totalNumberOfPosts;
		}

		$totalNumberOfPostsInQuery = $the_query->found_posts;
		$maxNumberOfPostsReached = false;

		if ($post_number > $totalNumberOfPostsInQuery || $post_number == $totalNumberOfPostsInQuery) {
			$maxNumberOfPostsReached = true;
		}
		if (!$maxNumberOfPostsReached) :
			if ($afficher_le_bouton_charger_plus) : ?>
				<div class="chargerdavantage_produits content_width padding_section_top">
					<div class="cta_btn_lead"><button original-post-number="<?= $post_number ?>" post-number="<?= $post_number ?>" post-type="<?= $post_type ?>" id="loadMorePhpWithoutFilters" type-extrait="<?= $typeExtrait ?>" taxonomie-choisie="<?= $taxonomie_choisie ?>" terme-choisi="<?= $terme_choisi ?>">
							<?php
							$loadMoreText = get_field('load_more_text', 'option');
							if ($loadMoreText) :
								echo $loadMoreText;
							else :
								echo 'Charger davantage';
							endif; ?>
						</button></div>
				</div>
		<?php
			endif;
		endif;
		wp_reset_query();
		?>
	<?php endif; ?>
</div>