<?php $masquer_le_prefooter = get_field('masquer_le_prefooter', 'option'); ?>
<?php $masquer_les_coordonnees = get_field('masquer_les_coordonnees', 'option'); ?>
<?php $masquer_les_prestations = get_field('masquer_les_prestations', 'option'); ?>
<?php $masquer_les_certifications = get_field('masquer_les_certifications', 'option'); ?>
<?php $masquer_le_logo = get_field('masquer_le_logo', 'option'); ?>
<?php $texte_inscription_newsletter = get_field('texte_inscription_newsletter', 'option'); ?>
<?php $texte_titre_coordonnees = get_field('texte_titre_coordonnees', 'option'); ?>
<?php $logo_bretagne_a_droite_du_footer = get_field('logo_bretagne_a_droite_du_footer', 'option') ?>
<?php $texte_afficher_le_numero = get_field('texte_afficher_le_numero', 'option'); ?> 

<?php if (!$masquer_le_prefooter) : ?>
	<aside id="aside_prefooter" class="padding_section">
		<div id="aside_prefooter_wrapper" class="">
			<div class="aside_prefooter_col prefooter_col_1">
				<?php if (!$masquer_les_coordonnees) : ?>
					<?php $importer_le_logo_footer = get_field('importer_le_logo_footer', 'option'); ?>
					<?php $dimensions_logo_prefooter = get_field('dimensions_logo_prefooter', 'option'); ?>
					<figure id="logo_footer" class="<?php echo $dimensions_logo_prefooter; ?>">
						<img src="<?php echo $importer_le_logo_footer; ?>" alt="Logo <?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>">
					</figure>
					<?php $accroche_sous_le_logo_footer = get_field('accroche_sous_le_logo_footer', 'option'); ?>
					<?php if ($accroche_sous_le_logo_footer) : ?>
						<p id="aside_prefooter_baseline"><?php echo $accroche_sous_le_logo_footer; ?></p>
					<?php endif; ?>
					<p class="cta_btn_lead cta_ternaire newsletter-mobile"><a id="newsletter-button-footer"><?= $texte_inscription_newsletter ?></a></p>

					<h3 class="titre-coordonnees"><?= $texte_titre_coordonnees ?><h3>
							<?php $nom = get_field('nom', 'option'); ?>
							<?php $adresseligne1 = get_field('adresse_ligne_1', 'option'); ?>
							<?php $adresseligne2 = get_field('adresse_ligne_2', 'option'); ?>
							<?php $adresseligne3 = get_field('adresse_ligne_3', 'option'); ?>
							<?php $numerodetelephone = get_field('numero_de_telephone', 'option'); ?>
							<?php $email = get_field('email', 'option'); ?>
							<?php $horaires = get_field('horaires', 'option'); ?>

							<?php if ($adresseligne1 || $adresseligne2 || $adresseligne3) : ?>
								<?php if ($numerodetelephone) : ?>
									<p class="coordonnees_p_i legende phone_number">
										<?= apply_filters('add_svg', 'phone') ?>
										<span id="afficherNumeroTelephone"><?php echo $texte_afficher_le_numero; ?></span>
										<span id="numeroTelephone"><?php echo $numerodetelephone ?></span>
									</p>
								<?php endif; ?>
								<p class="coordonnees_p_i legende">
									<?= apply_filters('add_svg', 'map-marker') ?>
									<?php if ($adresseligne1) : ?>
										<?php echo $adresseligne1 ?><br>
									<?php endif; ?>
									<?php if ($adresseligne2) : ?>
										<?php echo $adresseligne2 ?><br>
									<?php endif; ?>
									<?php if ($adresseligne3) : ?>
										<?php echo $adresseligne3 ?>
									<?php endif; ?>
								</p>
							<?php endif; ?>


							<?php if ($horaires) : ?>
								<p class="coordonnees_p_i legende">
									<?= apply_filters('add_svg', 'clock') ?>
									<?php echo $horaires ?>
								</p>
							<?php endif; ?>
						<?php endif; ?>
			</div>
			<div class="aside_prefooter_col prefooter_col_2">
				<p class="cta_btn_lead cta_ternaire newsletter-desktop"><a id="newsletter-button-footer"><?= $texte_inscription_newsletter ?></a></p>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'menu-footer-2',
				));
				?>
			</div>

			<?php $iframe_newsletter_footer = get_field('iframe_pour_la_newsletter', 'option'); ?>
			<div class="newsletter-container-footer-feed" id="newsletter-footer" style="display: none">
				<div class=" newsletter-wrapper-footer-feed">
					<div id="close-button-footer">X</div>
					<?= $iframe_newsletter_footer ?>
				</div>
			</div>

			<div class="aside_prefooter_col prefooter_col_3">
				<?php if (!$masquer_les_certifications) : ?>
					<?php $certifications_footer = get_field('certifications_footer', 'option'); ?>
					<h3><?php if ($certifications_footer) : ?><?php echo $certifications_footer; ?><?php endif; ?></h3>
					<?php if (have_rows('logos_certifications', 'option')) : ?>
						<div id="footer_certification_wrapper">
							<?php while (have_rows('logos_certifications', 'option')) : the_row(); ?>
								<?php $logo_de_la_certification = get_sub_field('logo_de_la_certification', 'option');
								$size_logo_de_la_certification = 'thumbnail'; ?>
								<?php if (have_rows('informations_certification', 'option')) : ?>
									<?php while (have_rows('informations_certification', 'option')) : the_row();
										$nom_de_la_certification = get_sub_field('nom_de_la_certification', 'option');
										$lien_vers_la_certification = get_sub_field('lien_vers_la_certification', 'option'); ?>
										<figure class="footer_certification">
											<?php if ($lien_vers_la_certification) : ?><a href="<?php echo $lien_vers_la_certification; ?>" target="_blank"><?php endif; ?>
												<?php if ($nom_de_la_certification) : ?>
													<?php $attr['alt'] = $nom_de_la_certification; ?>
													<?php echo wp_get_attachment_image($logo_de_la_certification, $size_logo_de_la_certification, "", $attr); ?>
												<?php endif; ?>
												<?php if (!$nom_de_la_certification) : ?>
													<?php echo wp_get_attachment_image($logo_de_la_certification, $size_logo_de_la_certification, ""); ?>
												<?php endif; ?>
												<?php if ($lien_vers_la_certification) : ?></a><?php endif; ?>
										</figure>

									<?php endwhile; ?>
								<?php else : ?>
									<figure class="footer_certification">
										<?php echo wp_get_attachment_image($logo_de_la_certification, $size_logo_de_la_certification, ""); ?>
									</figure>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					<?php else : endif; ?>
				<?php endif; ?>
			</div>
			<img class="logo-bzh-footer" src="<?= $logo_bretagne_a_droite_du_footer ?>">
		</div>
		<div class="remove_margin"></div>
	</aside>
<?php endif; ?>