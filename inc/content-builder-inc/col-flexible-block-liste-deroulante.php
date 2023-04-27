<div class="col_flexible_item bloc_liste_deroulante">
    <div class="entry-content bloc_questions_reponses">
        <?php 
        if (have_rows('questions_reponses')) :
            while (have_rows('questions_reponses')) : the_row(); ?>
                <?php $question_faq = get_sub_field('question_faq'); ?>
                <?php $reponse_faq = get_sub_field('reponse_faq'); ?>
                <div class="question_reponse_item">
                    <div class="question_reponse_title">
                        <h3><?php echo $question_faq; ?></h3>
                        <div class="question_reponse_title_icone">
                            <span class="question_reponse_title_icone_plus">
                            <?= showSvg(get_stylesheet_directory_uri() . '/svg/fleche_haut.svg') ?>      
                            </span>
                            <span class="question_reponse_title_icone_moins">
                            <?= showSvg(get_stylesheet_directory_uri() . '/svg/fleche_bas.svg') ?>      
                            </span>
                        </div>
                    </div>
                    <div class="question_reponse_wysiwyg entry-content"><?php echo $reponse_faq; ?></div>
                </div>
        <?php endwhile;
        endif; ?>
    </div>
</div>