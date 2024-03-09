<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package White_Roses
 */

get_header();

$page_text = carbon_get_theme_option( '404_text' );
$cta_text = carbon_get_theme_option( '404_link_title' );
$page_image = carbon_get_theme_option( '404_image' );
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php echo $page_text; ?></h1>
				<img src="<?php echo $page_image; ?>" />
				<a href="/" aria-label="return home">
					<?php if ( $cta_text != '' ) : ?>
						<h2><?php echo $cta_text; ?></h2>
					<?php else : ?>
						<h2>Return Home</h2>
					<?php endif; ?>
				</a>
			</header><!-- .page-header -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
