<?php $post_id = get_the_ID();

// des champs rajoutés pour l'extrait lié au type de post
$nouveaute_de_extrait = get_field('nouveau', $post_id);
$description_courte = get_field('description_extrait_de_la_page', $post_id);

// Les champs présents dans le bloc 
$texte_pour_le_bouton_en_savoir_plus = get_sub_field('texte_pour_le_bouton_en_savoir_plus');
?>

<?php
$terms = array();
foreach (get_post_taxonomies($post_id) as $taxonomy) {
    foreach (wp_get_post_terms($post_id, $taxonomy) as $term) {
        $terms[] = $term->name;
    }
}

?>
<div class="cpt-extrait">
    <div class="terms extrait-defaut">
        <?php if (isset($terms[0])) : ?>
            <span class="term taxo-0">
                <?= $terms[0] ?>
            </span>
        <?php endif; ?>
        <?php if (isset($terms[1])) : ?>
            <span class="term taxo-1">
                <?= $terms[1] ?>
            </span>
        <?php endif; ?>
    </div>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <?php if ($description_courte) : ?>
        <p class="desc-page"><?php echo $description_courte; ?></p>
    <?php endif; ?>
    <div class="buttons-extrait">
        <p class="cta_btn_lead cta_primaire cta_center"><a href="<?php the_permalink(); ?>"><?= $texte_pour_le_bouton_en_savoir_plus ?></a></p>
    </div>
</div>