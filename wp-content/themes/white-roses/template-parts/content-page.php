<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package White_Roses
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$page_id = get_the_ID();
		if( !empty( $page_id ) ) {
			$show_title = get_post_meta( $page_id, 'show-page-title', true );
			$custom_title = get_post_meta( $page_id, 'custom-page-title', true );
			$page_intro = get_post_meta( $page_id, 'page-intro-text', true );
			$hero_cta_url = get_post_meta( $page_id, 'page-hero-cta-url', true );
			$hero_cta_text = get_post_meta( $page_id, 'page-hero-cta-text', true );
		}
		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	?>

	<header class="entry-header">
		<div class="hero-container <?php echo ( has_post_thumbnail() ) ? 'has-img' : null; ?>">
			<?php if( has_post_thumbnail() ) : ?>
				<div class="hero-img">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>
			<?php if ( !is_front_page() ) : ?>
				<div class="intro-content">
					<h1><?php echo the_title(); ?></h1>
				</div>
			<?php endif; ?>
			<?php if ( $hero_cta_url && $hero_cta_text ) : ?>
			<div class="hero-cta">
				<div class="cta-container">
					<?php if ( is_front_page() ) : ?>
						<a href="<?php echo $hero_cta_url ?>"><?php echo $hero_cta_text; ?></a>
					<?php else : ?>
						<a href="<?php echo $hero_cta_url ?>"><?php echo $hero_cta_text; ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</header><!-- .entry-header -->

	<?php
		if ( !is_front_page() ) :
			if(function_exists('bcn_display'))
			{
				?>
				<div class="breadcrumbs">
					<?php bcn_display(); ?>
				</div>
				<?php
			}
		endif;
	?>


	<div class="entry-content">

		<?php

		the_content();

		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
