<?php $liste_icones = get_sub_field('liste_icones'); ?>
<div class="col_flexible_item">
	<div>
		<?php if (have_rows('liste_icones')) : ?>
			<?php while (have_rows('liste_icones')) : the_row();
				$icone_texte = get_sub_field('icone_texte');
				$icone_svg = get_sub_field('icone_svg');
			?>
				<div class="element_liste_icones entry-content">
					<div class="liste_icone_svg">
						<div class="liste_icone_svg_wrapper">
							<?= print_r($icone_svg) ?>
						</div>
					</div>
					<div class="liste_icone_txt entry-content">
						<?php echo $icone_texte; ?>
					</div>
				</div>
			<?php endwhile; ?>
		<?php else : endif; ?>
	</div>
</div>