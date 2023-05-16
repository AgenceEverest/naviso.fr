<?php $liste_icones = get_sub_field('liste_icones'); ?>
<div class="col_flexible_item">
	<div>
	    <?php if( have_rows('liste_icones') ):?>
			<?php while ( have_rows('liste_icones') ) : the_row(); ?>
				
				<div class="element_liste_icones entry-content">
					<div class="liste_icone_svg">
						<div class="liste_icone_svg_wrapper">
							<?php 
								$icone_svg = get_sub_field('icone_svg'); 
								$urltheme = get_stylesheet_directory_uri();
								$pathToSVG = $urltheme . '/img/icons/' .$icone_svg. '.svg';
								$iconeSVG = file_get_contents($pathToSVG); 
								echo $iconeSVG; ?>
						</div>
					</div>
					<div class="liste_icone_txt entry-content">
						<?php $icone_texte = get_sub_field('icone_texte'); ?>
						<?php echo $icone_texte; ?>
					</div>
				</div>
			<?php endwhile; ?>
		<?php else : endif; ?>
	</div>
</div>