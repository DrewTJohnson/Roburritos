<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package White_Roses
 */

?>

<article id="post-<?php the_ID(); ?>" class="search-item">
	<a href="<?php echo get_permalink(); ?>" rel="bookmark">
		<p class="search-title"><?php echo the_title(); ?></p>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
