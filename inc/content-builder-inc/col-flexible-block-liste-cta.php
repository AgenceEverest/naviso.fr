<?php $ajouter_une_bordure = get_sub_field('ajouter_une_bordure');
    $ajouter_un_call_to_action = get_sub_field('ajouter_un_call-to-action');
    $position_du_bouton = get_sub_field('position_du_bouton');
    $ajouter_un_deuxieme_call_to_action = get_sub_field('ajouter_un_deuxieme_call-to-action');
    $texte = get_sub_field('texte'); 
    $alignement_des_boutons_de_la_colonne = get_sub_field('alignement_des_boutons_de_la_colonne'); ?>
 <div class="col_flexible_item<?php if ($position_du_bouton == 'bouton_bas_colonne' && $ajouter_un_call_to_action) : ?> col_flexible_cta<?php endif; ?><?php if ($ajouter_une_bordure) : ?> col_flexible_bordure<?php endif; ?><?php if (!$ajouter_une_bordure) : ?> col_flexible_sansbordure<?php endif; ?>">
     <div class="entry-content <?= $alignement_des_boutons_de_la_colonne ?>">
         <?php
            // Check rows exists.
            if (have_rows('liste_de_bouton')) :
                // Loop through rows.
                while (have_rows('liste_de_bouton')) : the_row();
                    // Load sub field value.
                    get_template_part('inc/content-builder-inc/cta-pour-repeteur')
                    ?>
         <?php endwhile;
            endif; ?>

         <?php if ($ajouter_un_call_to_action && $position_du_bouton == 'bouton_sous_texte') : ?>
             <div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
                                        endif; ?>">
                 <?php if (have_rows('call-to-action')) : ?>
                     <?php while (have_rows('call-to-action')) : the_row(); ?>
                         <?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
                     <?php endwhile; ?>
                 <?php endif; ?>
                 <?php if (have_rows('call-to-action_2')  && $ajouter_un_deuxieme_call_to_action) : ?>
                     <?php while (have_rows('call-to-action_2')) : the_row(); ?>
                         <?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
                     <?php endwhile; ?>
                 <?php endif; ?>
             </div>
         <?php endif; ?>
     </div>
     <?php if ($ajouter_un_call_to_action && $position_du_bouton == 'bouton_bas_colonne') : ?>
         <div class="cta-container <?php if ($ajouter_un_deuxieme_call_to_action) : echo ' double-cta';
                                    endif; ?>">
             <?php if (have_rows('call-to-action')) : ?>
                 <?php while (have_rows('call-to-action')) : the_row(); ?>
                     <?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
                 <?php endwhile; ?>
             <?php endif; ?>
             <?php if (have_rows('call-to-action_2') && $ajouter_un_deuxieme_call_to_action) : ?>
                 <?php while (have_rows('call-to-action_2')) : the_row(); ?>
                     <?php get_template_part('inc/content-builder-inc/call-to-action'); ?>
                 <?php endwhile; ?>
             <?php endif; ?>
         </div>
     <?php endif; ?>
 </div>