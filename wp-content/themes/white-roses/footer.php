<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package White_Roses
 */

?>

<?php if ( !is_checkout() && !is_cart() ) : ?>
<div class="pre-footer">
	<h2 class="wp-block-heading has-text-align-center is-style-rotated-heading"><?php echo carbon_get_theme_option( 'prefooter_text' ); ?></h2>
	<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-layout-1 wp-block-buttons-is-layout-flex">
		<div class="wp-block-button is-style-primary-button">
			<a href="<?php echo carbon_get_theme_option( 'prefooter_url' ); ?>" class="wp-block-button__link has-text-align-left wp-element-button" target="_blank"><strong><?php echo carbon_get_theme_option( 'prefooter_button_text' ); ?></strong></a>
		</div>
	</div>
</div>
<?php endif; ?>

<footer id="colophon" class="site-footer">
	<div class="footer">
		<div class="site-info">
			<div class="site-branding">
					<?php
					the_custom_logo();
					if ( !has_custom_logo() ) :
						if (is_front_page() && is_home()) :
						?>
							<h3 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h3>
						<?php
						else :
						?>
							<h3 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h3>
						<?php
						endif; 
					endif;
					?>
			</div><!-- .site-branding -->
			<div class="footer-locations">
				<?php $locations_title = carbon_get_theme_option( 'crb_locations_title' ); ?>
				<?php $locations = carbon_get_theme_option( 'crb_locations' ); ?>

				<?php if ( $locations ) : ?>
					<div class="locations">
						<h4><?php echo $locations_title; ?></h4>

						<ul>
						<?php 
							foreach ( $locations as $location ) {
									$location_name = $location['location'];
									$phone_link = $location['phone_link'];
									$phone_number = $location['phone_number'];
								?>
									<li><?php echo $location_name; ?> - <a href="tel:<?php echo $phone_link; ?>"><?php echo $phone_number; ?></a></li>
								<?php
							}
						?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
			<div class="footer-inquiries">
				<?php 
					$inquiries_title = carbon_get_theme_option( 'crb_inquiries_title' );
					$inquiries = carbon_get_theme_option( 'crb_inquiries' );
				
					if( $inquiries ) : ?>

					<h4><?php echo $inquiries_title; ?></h4>
					
					<ul>
						<?php
							foreach ( $inquiries as $inquiry ) {
								$inquiry_title = $inquiry['inquiry_title'];
								$inquiry_email = $inquiry['inquiry_email'];
								?>
									<li><?php echo $inquiry_title; ?> - <a href="mailto:<?php echo $inquiry_email; ?>"><?php echo $inquiry_email; ?></a></li>
								<?php
							}
						?>
					</ul>
					<?php endif; ?>

			</div>
		</div><!-- .site-info -->
	</div>
	<div class="copyright-container">
		<p class="copyright">© 2023 Roburrito's</p>
		<div class="privacy-policy">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-4',
					'menu_id'        => 'privacy-policy',
				)
			);
			?>
		</div>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
