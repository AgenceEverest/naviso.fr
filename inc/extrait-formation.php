<?php $post_id = get_the_ID();

// des champs rajoutés pour l'extrait lié au type de post
$nouveaute_de_extrait = get_field('nouveau', $post_id);
$description_courte = get_field('description_extrait_de_la_page', $post_id);
$premiere_taxonomie_du_bandeau = get_field('premiere_taxonomie_du_bandeau', $post_id);
$deuxieme_taxonomie_du_bandeau = get_field('deuxieme_taxonomie_du_bandeau', $post_id);
$duree = get_field('duree', $post_id);
$prochaine_session = get_field('prochaine_session', $post_id);
$fichier_a_telecharger = get_field('fichier_a_telecharger', $post_id);


// Les champs présents dans le bloc 
$texte_pour_le_champ_duree = get_sub_field('texte_pour_le_champ_duree');
$texte_pour_le_champ_prochaine_session_sur_lextrait = get_sub_field('texte_pour_le_champ_prochaine_session_sur_lextrait');
$texte_pour_le_bandeau_nouveau = get_sub_field('texte_pour_le_bandeau_nouveau');
$texte_pour_le_bouton_en_savoir_plus = get_sub_field('texte_pour_le_bouton_en_savoir_plus');
$texte_bouton_telechargement = get_sub_field('texte_bouton_telechargement');
?>

<?php
$terms = array();
foreach (get_post_taxonomies($post_id) as $taxonomy) {
    foreach (wp_get_post_terms($post_id, $taxonomy) as $term) {
        $terms[] = $term->name;
    }
}

?>
<div class="extrait_formation">
    <div class="extrait_content">
        <div class="terms">
        <?php if (isset($terms[0])) : ?>
            <p class="term term-1">
                <?= $terms[0] ?>
            </p>
        <?php endif; ?>
        <?php if (isset($terms[1])) : ?>
            <p class="term term-2">
                <?= $terms[1] ?>
            </p>
        <?php endif; ?>
        <?php
        if ($nouveaute_de_extrait) :  ?>
            <p class="nouveaute-formation"><?= $texte_pour_le_bandeau_nouveau ?></p>
        <?php endif; ?>
        </div>
        <div class="entry-content">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <?php if ($description_courte) : ?>
                <p><?php echo $description_courte; ?></p>
            <?php endif; ?>
            <?php if ($duree) : ?>
                <p><span class="duree"><?= $texte_pour_le_champ_duree ?></span> <?= $duree ?></p>
                <p><span class="formation"><?= $texte_pour_le_champ_prochaine_session_sur_lextrait ?></span> <?= $prochaine_session ?></p>
            <?php endif; ?>
        </div>
        <div class="cta-container-formation-extrait">
            <?php if ($fichier_a_telecharger) : ?>
                <p class="cta_btn_lead cta_formation cta_ternaire"><a href="<?= $fichier_a_telecharger ?>"><?= $texte_bouton_telechargement ?></a></p>
            <?php endif; ?>
            <p class="cta_btn_lead cta_primaire"><a href="<?php the_permalink(); ?>"><?= $texte_pour_le_bouton_en_savoir_plus ?></a></p>
        </div>
    </div>
</div>