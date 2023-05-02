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
$texte_bouton_telechargement  = get_sub_field('texte_bouton_telechargement ');
?>

<div class="term_extrait">
    <div class="term_extrait_content">
        <figure>
            <a href="<?php echo the_permalink(); ?>">

                <?php $thumbnail = get_post_thumbnail_id();
                $size_thumbnail = "medium";
                $url_thumbnail = $thumbnail ? wp_get_attachment_image_url($thumbnail, $size_thumbnail) : null;
                $image_weight = $url_thumbnail ? apply_filters('get_weight_of_img', $url_thumbnail) : '0kb'; ?>

                <div class="poids-image"><span class="poids-image-icone"><?php get_template_part('svg/symbole-feuille-nanosite'); ?></span><span class="poids-image-data"><?= $image_weight ?></span></div>

                <?php if ($premiere_taxonomie_du_bandeau) : ?>
                    <p class="bandeau premier-bandeau">
                    
                    </p>
                <?php endif; ?>
                <?php if ($deuxieme_taxonomie_du_bandeau) : ?>
                        <p class="bandeau deuxieme-bandeau">

                        </p>
                <?php endif; ?>
                <?php
                if ($nouveaute_de_extrait) :  ?>
                    <p class="nouveaute_bandeau"><?= $texte_pour_le_bandeau_nouveau ?></p>
                <?php endif; ?>
                <?php echo wp_get_attachment_image($thumbnail, $size_thumbnail, ""); ?>
            </a>
        </figure>
        <div class="entry-content">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <?php if ($description_courte) : ?>
                <p><?php echo $description_courte; ?></p>
            <?php endif; ?>
            <?php if ($duree) : ?>
                <p><?= $texte_pour_le_champ_duree ?> <?= $duree ?></p>
                <p><?= $texte_pour_le_champ_prochaine_session_sur_lextrait ?> <?= $prochaine_session ?></p>
            <?php endif; ?>
        </div>
        <div class="cta-container-formation-extrait">
            <?php if ($fichier_a_telecharger) : ?>
                <p class="cta_btn_lead"><a href="<?= $fichier_a_telecharger ?>" target="_blank"><?= $texte_bouton_telechargement ?></a></p>
            <?php endif; ?>
            <p class="cta_btn_lead"><a href="<?php the_permalink(); ?>"><?= $texte_pour_le_bouton_en_savoir_plus ?></a></p>
        </div>
    </div>
</div>