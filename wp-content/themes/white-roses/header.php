<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package White_Roses
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'white-roses'); ?></a>

		<header id="secondaryhead" class="secondary-header">
			<div class="secondary-wrap">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-5',
							'menu_id'        => 'secondary',
						)
					);
				?>
			</div>
		</header>

		<header id="masthead" class="site-header">
			<div class="header-wrap">
				<div class="site-branding">
					<?php
					the_custom_logo();
					?>
				</div>

				<nav id="site-navigation" class="main-navigation" aria-labelledby="#nav1">
					<p class="aria-landmark-hidden" id="nav1">Main Navigation</p>
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'white-roses'); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
					<button class="search-toggle" aria-controls="search" aria-expanded="false" title="Open Search">
						<span class="sr-only">Search</span>
						<svg class="open" width="15" height="15" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"></path></svg>
						<svg class="close" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="Menu / Close_MD">
							<path id="Vector" d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</g>
						</svg>
					</button>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->
		<?php get_search_form(); ?>