<?php $ajouter_une_bordure = get_sub_field('ajouter_une_bordure'); ?>
<?php $texte_de_la_citation_col = get_sub_field('texte_de_la_citation_col'); ?>
<?php $alignement_de_la_citation = get_sub_field('alignement_de_la_citation'); ?>
<?php $titre = get_sub_field('titre') ?>
<?php $nom = get_sub_field('nom') ?>
<?php $prenom = get_sub_field('prenom') ?>
<?php $image = get_sub_field('image') ?>

<div class="col_flexible_item quotes-container">
    <?= showSvg(get_stylesheet_directory_uri() . '/svg/quotes.svg') ?>
    <?php if ($ajouter_une_bordure) : ?><div class="col_flexible_bordure"><?php endif; ?>
        <?php if (!$ajouter_une_bordure) : ?><div class="col_flexible_sansbordure"><?php endif; ?>
            <div class="entry-content">
                <?php if ($texte_de_la_citation_col) : ?>
                    <p class="texte_bloc_citation chapeau <?php echo $alignement_de_la_citation; ?>"><?php echo $texte_de_la_citation_col; ?></p>
                <?php endif; ?>
            </div>
            <div class="entry-content formateur">
                <div class="image"><img src="<?= $url = $image ? $image['url'] : ''; ?>" alt="<?= $alt = $image ? $image['alt'] : ''; ?>"> </div>
                <div class="texte">
                    <?php if ($titre) : ?>
                        <h4 class="titre">
                            <?= $titre ?>
                        </h4>
                    <?php endif; ?>
                    <?php if ($nom || $prenom) : ?>
                        <p class="identite">
                            <?php if ($nom) : ?>
                                <span><?= $nom ?></span>
                            <?php endif; ?>
                            <?php if ($prenom) : ?>
                                <span><?= $prenom ?></span>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($ajouter_une_bordure) : ?>
            </div><?php endif; ?>
        <?php if (!$ajouter_une_bordure) : ?></div><?php endif; ?>
</div>