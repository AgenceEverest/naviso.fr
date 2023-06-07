<?php $post_id = get_the_ID();

// des champs rajoutés pour l'extrait lié au type de post
$nouveaute_de_extrait = get_field('nouveau', $post_id);
$description_courte = get_field('description_extrait_de_la_page', $post_id);

// Les champs présents dans le bloc 
$texte_pour_le_bouton_en_savoir_plus = get_sub_field('texte_pour_le_bouton_en_savoir_plus');
?>

<?php
/* $terms = array();
foreach (get_post_taxonomies($post_id) as $taxonomy) {
    foreach (wp_get_post_terms($post_id, $taxonomy) as $term) {
        $terms[] = $term->name;
    }
} */

?>
<div class="cpt-extrait">
    <div class="terms extrait-defaut">
        <?php
        $post_id = get_the_id();
        $taxonomies = get_post_taxonomies($post_id);
        $index = 0;
        foreach ($taxonomies as $taxonomy) {
            if ($taxonomy !== 'tri_pour_page_formation') {

                $terms = get_the_terms($post_id, $taxonomy);
                if (is_array($terms) || is_object($terms)) {
                    if (count($terms) > 0) {
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                echo '<p class="term term-' . $index . '">' . $term->name . '</p>';
                                $index++;
                            }
                        }
                    }
                }
            }
        }
        ?>
    </div>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <?php if ($description_courte) : ?>
        <p class="desc-page"><?php echo $description_courte; ?></p>
    <?php endif; ?>
    <div class="buttons-extrait">
        <p class="cta_btn_lead cta_primaire cta_center"><a href="<?php the_permalink(); ?>"><?= $texte_pour_le_bouton_en_savoir_plus ?></a></p>
    </div>
</div>