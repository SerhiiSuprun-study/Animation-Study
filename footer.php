<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell medium-3">
				<div class="footer__logo">
					<?php if ( $footer_logo = get_field( 'footer_logo', 'options' ) ):
						$logo_image = wp_get_attachment_image( $footer_logo['id'], 'medium', false, [
							'class'    => 'custom-logo',
							'itemprop' => 'siteLogo',
							'alt'      => get_bloginfo( 'name' ),
						] );
						echo sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" title="%2$s" itemscope>%3$s</a>', esc_url( home_url( '/' ) ), get_bloginfo( 'name' ), $logo_image );
					else:
						show_custom_logo();
					endif; ?>
				</div>
			</div>
			<div class="cell medium-6">
				<?php
				if ( has_nav_menu( 'footer-menu' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu menu', 'depth' => 1 ) );
				}
				?>
			</div>
			<div class="cell medium-3 footer__sp">
				<?php get_template_part( 'parts/socials' ); // Social profiles ?>
			</div>
		</div>
	</div>

	<?php if ( $copyright = get_field( 'copyright', 'options' ) ): ?>
		<div class="footer__copy">
			<div class="grid-container">
				<div class="grid-x grid-padding-x">
					<div class="cell ">
						<?php echo $copyright; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>