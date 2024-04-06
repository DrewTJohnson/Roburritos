<?php
/**
 * White Roses functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package White_Roses
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * 
 * 
 * Enable carbon fields
 * 
 */
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    $globals_options_container = Container::make( 'theme_options', __( 'Globals' ) )
		-> set_page_menu_position( 60 )
        ->add_fields( array(
			Field::make( 'header_scripts', 'crb_header_script', __( 'Header Script' ) ),
			Field::make( 'footer_scripts', 'crb_footer_script', __( 'Footer Script' ) ),
        ) );
	
	Container::make( 'theme_options', __( 'Footer & Pre-Footer' ) )
		-> set_page_parent( $globals_options_container )
		-> add_fields( array (
			Field::make( 'text', 'prefooter_text', 'Prefooter Text'),
			Field::make( 'text', 'prefooter_button_text', 'Prefooter Button Text'),
			Field::make( 'text', 'prefooter_url', 'Prefooter Url'),
			Field::make( 'text', 'crb_locations_title', 'Locations Title' ),
			Field::make( 'complex', 'crb_locations', 'Locations' )
				-> set_layout( 'tabbed-vertical' )
				-> add_fields( array (
						Field::make( 'text', 'location', 'Location' ),
						Field::make( 'text', 'phone_link', 'Phone Link' ),
						Field::make( 'text', 'phone_number', 'Phone Number' ),
					) )
				-> set_header_template( '
					<% if ( location ) { %>
						<%- location %>
					<% } %>
				' ),
			Field::make( 'text', 'crb_inquiries_title', 'Inquiries Title' ),
			Field::make( 'complex', 'crb_inquiries', 'Inquiries' )
				-> set_layout( 'tabbed-vertical')
				-> add_fields( array (
					Field::make( 'text', 'inquiry_title', 'Inquiry Title' ),
					Field::make( 'text', 'inquiry_url', 'Inquiry Url' ),
					Field::make( 'checkbox', 'is_email', 'Is Email?')
				) )
				-> set_header_template( '
					<% if ( inquiry_title ) { %>
						<%- inquiry_title %>
					<% } %>
				' ),
			Field::make( 'complex', 'crb_socials', 'Social Links' )
				-> set_layout( 'tabbed-vertical')
				-> add_fields( array (
					Field::make( 'text', 'social_title', 'Social Media Site' ),
					Field::make( 'text', 'social_url', 'Social Media URL' ),
				) )
				-> set_header_template( '
					<% if ( social_title ) { %>
						<%- social_title %>
					<% } %>
				' ),
		) );
	
	Container::make( 'theme_options', __( 'Alerts' ) ) 
		-> set_page_parent( $globals_options_container )
		-> add_fields( array (
			Field::make( 'text', 'site_alert', 'Site Alert' ),
			Field::make( 'text', 'checkout_alert', 'Checkout Alert' )
		) );
}

function easy_breadcrumbs($post) {
    $parent_id = $post->post_parent;
    if ($parent_id == 0) { return false; }
    else {
        $output = '';
        while ($parent_id != 0) {
            $ancestor = get_post($parent_id);
            $output = '<li><a href="'.get_permalink($ancestor->ID).'">'.$ancestor->post_title.'</a></li>' . $output;

            $parent_id = $ancestor->post_parent;
        }
        return '<ul class="breadcrumbs"><li><a href="'.home_url().'">Home</a></li>'.$output.'</ul>';
    }
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function white_roses_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on White Roses, use a find and replace
		* to change 'white-roses' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'white-roses', get_template_directory() . '/languages' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'woocommerce' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'white-roses' ),
			'menu-2' => esc_html__( 'Footer Callout', 'white-roses' ),
			'menu-3' => esc_html__( 'Footer Menu', 'white-roses' ),
			'menu-4' =>	esc_html__( 'Privacy Menu', 'white-roses' ),
			'menu-5' => esc_html__( 'Secondary', 'white-roses'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'white_roses_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'yoast-seo-breadcrumbs' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'white_roses_setup' );

// Enqueue custom block styles
add_action( 'after_setup_theme', 'white_roses_init_block_styles' );
function white_roses_init_block_styles() {
	register_block_style( 'bouquet-of-roses/split-text', [
		'name'	=>	'blue-background',
		'label'	=>	__('Blue Background'),
		'style_handle'	=>	'block-styles',
	] );
	register_block_style( 'core/image', [
		'name'	=>	'rounded-corners',
		'label'	=>	__('Rounded Corners'),
		'style_handle'	=>	'block-styles',
	] );
}

// register custom post types
function robs_menu_items_post_type() {
	register_post_type('robs_menu_item', 
		array(
			'labels'	=>	array(
				'name'	=>	__( 'Menu Items' ),
				'singular_name'	=>	__( 'Menu Item' ),
			),
			'public'	=>	true,
			'has_archive'	=>	false,
			'taxonomies'	=>	array( 'category' ),
			'supports'	=>	array( 'title' ),
			'show_in_rest'	=>	true,
		)
	);
}
add_action('init', 'robs_menu_items_post_type');

// register custom taxonomy for custom post type
function robs_menu_item_register_taxonomy_sub_menu() {
	$labels = array(
		'name'	=>	__( 'Submenus' ),
		'singular_name'	=>	__( 'Submenu' ),
		'search_items'	=>	__( 'Search Submenus' ),
		'all_items'	=>	__( 'All Submenus' ),
		'edit_item'	=>	__( 'Edit Submenu' ),
		'update_item'	=>	__( 'Update Submenu' ),
		'add_new_item'	=>	__( 'Add New Submenu' ),
		'new_item_name'	=>	__( 'New Submenu Name' ),
		'menu_name'	=>	__( 'Submenu' )
	);
	$args = array(
		'hierarchical'	=>	true,
		'labels'	=>	$labels,
		'show_ui'	=>	true,
		'show_admin_column'	=>	true,
		'query_var'	=>	true,
		'rewrite'	=>	[ 'slug' => 'submenu' ],
	);
	register_taxonomy( 'submenu', [ 'robs_menu_item' ], $args );
}
add_action( 'init', 'robs_menu_item_register_taxonomy_sub_menu' );

add_action( 'wp_enqueue_scripts', 'white_roses_init_stylesheet', 99 );
function white_roses_init_stylesheet() {
	$css_dir = get_stylesheet_directory_uri() . '/inc/css';
	wp_enqueue_style( 'block-style', $css_dir . '/block-styles.css', false );
}

add_action( 'enqueue_block_editor_assets', 'white_roses_editor_assets', 100 );
function white_roses_editor_assets() {
	$css_dir = get_stylesheet_directory_uri() . '/inc/css';
	wp_enqueue_style( 'block-style', $css_dir . '/block-styles.css', [ 'wp-edit-blocks' ], '' );
}

function white_roses_admin_styles() {
	$css_dir = get_stylesheet_directory_uri() . '/inc/css';
	wp_enqueue_style( 'admin-style', $css_dir . '/admin.css', false );
}
add_action( 'admin_enqueue_scripts', 'white_roses_admin_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function white_roses_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'white_roses_content_width', 640 );
}
add_action( 'after_setup_theme', 'white_roses_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function white_roses_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'white-roses' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'white-roses' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'white_roses_widgets_init' );

function white_roses_add_post_meta_boxes() {
	add_meta_box(
		'show-page-title',
		__( 'Show Page Title' ),
		'white_roses_show_title_meta_box',
		'page',
		'advanced',
		'core'
	);
	add_meta_box(
		'custom-page-title',
		__( 'Custom Page Title' ),
		'white_roses_custom_title_meta_box',
		'page',
		'normal',
		'high'
	);
	add_meta_box(
		'page-intro-text',
		__('Page Intro Text'),
		'white_roses_page_intro_meta_box',
		'page',
		'normal',
		'high'
	);
	add_meta_box(
		'page-hero-cta-url',
		__('Hero CTA URL'),
		'white_roses_hero_cta_url_meta_box',
		'page',
		'normal',
		'high'
	);
	add_meta_box(
		'page-hero-cta-text',
		__('Hero CTA Text'),
		'white_roses_hero_cta_text_meta_box',
		'page',
		'normal',
		'high'
	);
	add_meta_box(
		'menu-item-price',
		__('Menu Item Price'),
		'white_roses_item_price_meta_box',
		'robs_menu_item',
		'side',
		'default'
	);
	add_meta_box(
		'menu-item-description',
		__('Menu Item Description'),
		'white_roses_item_description_meta_box',
		'robs_menu_item',
		'normal',
		'default'
	);
}

function white_roses_show_title_meta_box( $post ) {
	global $post;
	$custom_value = get_post_meta( $post->ID, 'show-page-title', true );

	?>
	
		<?php 
		
		$field_checked = '';
		
		if( $custom_value == "yes" ) {
			$field_checked = 'checked="checked"'; 
		}
		?>
		<input type="checkbox" id="showTitle" name="show-page-title" value="yes" <?php echo $field_checked; ?> />
		<label for="showTitle"><?php _e( 'Show Page Title?' ); ?></label>
	<?php
}

function white_roses_custom_title_meta_box( $post ) {
	global $post;
	$white_roses_meta_box_custom_title = get_post_meta( $post->ID, 'custom-page-title', true );

	?>
		<input type="text" id="customTitle" name="custom-page-title" value="<?php echo $white_roses_meta_box_custom_title; ?>" />
	<?php

}

function white_roses_item_price_meta_box( $post ) {
	global $post;
	$white_roses_item_price_meta_box = get_post_meta( $post->ID, 'menu-item-price', true );

	?>
		<input type="text" id="customTitle" name="menu-item-price" value="<?php echo $white_roses_item_price_meta_box; ?>" />
	<?php

}

function white_roses_item_description_meta_box( $post ) {
	global $post;
	$white_roses_item_description_meta_box = get_post_meta( $post->ID, 'menu-item-description', true );

	?>
		<textarea 
			id="customTitle" 
			rows="4" 
			name="menu-item-description" 
			style="width:100%;"><?php echo $white_roses_item_description_meta_box; ?></textarea>
	<?php

}

function white_roses_page_intro_meta_box( $post ) {
	global $post;
	$white_roses_meta_box_page_intro = get_post_meta( $post->ID, 'page-intro-text', true );
	?>
		<textarea type="text" id="pageIntroText" name="page-intro-text" style="width:100%;height:150px;"><?php echo $white_roses_meta_box_page_intro; ?></textarea>
	<?php
}

function white_roses_hero_cta_url_meta_box( $post ) {
	global $post;
	$white_roses_meta_box_hero_url = get_post_meta( $post->ID, 'page-hero-cta-url', true);

	?>
		<input type="text" id="pageHeroUrl" name="page-hero-cta-url" value="<?php echo $white_roses_meta_box_hero_url; ?>" />	
	<?php
}

function white_roses_hero_cta_text_meta_box( $post ) {
	global $post;
	$white_roses_meta_box_hero_text = get_post_meta( $post->ID, 'page-hero-cta-text', true);

	?>
		<input type="text" id="pageHeroText" name="page-hero-cta-text" value="<?php echo $white_roses_meta_box_hero_text; ?>" />	
	<?php
}

function robs_save_item_attributes( $post_id ) {
	global $post;

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}

	if( !is_object($post)) return;

	$menu_item_price = isset( $_POST['menu-item-price']) ? wp_filter_post_kses($_POST['menu-item-price']) : '';
	$menu_item_description = isset( $_POST['menu-item-description']) ? wp_filter_post_kses($_POST['menu-item-description']) : '';

	update_post_meta( $post_id, "menu-item-price", $menu_item_price );
	update_post_meta( $post_id, "menu-item-description", $menu_item_description );
}

function white_roses_save_show_title_meta( $post_id ) {
	global $post;

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}

	if( !is_object($post)) return;

	$page_title_check = isset( $_POST['show-page-title']) ? wp_filter_post_kses($_POST['show-page-title']) : '';
	$custom_title_check = isset( $_POST['custom-page-title']) ? wp_filter_post_kses($_POST['custom-page-title']) : '';
	$intro_text = isset( $_POST['page-intro-text']) ? wp_filter_post_kses($_POST['page-intro-text']) : '';
	$hero_main_cta_url = isset( $_POST['page-hero-cta-url']) ? wp_filter_kses($_POST['page-hero-cta-url']) : '';
	$hero_main_cta_text = isset( $_POST['page-hero-cta-text']) ? wp_filter_kses($_POST['page-hero-cta-text']) : '';

	update_post_meta( $post_id, "show-page-title", $page_title_check );
	update_post_meta( $post_id, "custom-page-title", $custom_title_check );
	update_post_meta( $post_id, "page-intro-text", $intro_text );
	update_post_meta( $post_id, "page-hero-cta-url", $hero_main_cta_url );
	update_post_meta( $post_id, "page-hero-cta-text", $hero_main_cta_text );
}

function white_roses_post_meta_boxes_setup() {

	add_action( 'add_meta_boxes', 'white_roses_add_post_meta_boxes' );

	add_action( 'save_post', 'white_roses_save_show_title_meta', 10, 2);
	add_action( 'save_post', 'robs_save_item_attributes', 10, 2 );
}

add_action( 'load-post.php', 'white_roses_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'white_roses_post_meta_boxes_setup' );

/**
 * Enqueue scripts and styles.
 */
function white_roses_scripts() {
	wp_enqueue_style( 'white-roses-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'white-roses-style', 'rtl', 'replace' );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'white-roses-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'white-roses-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), _S_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'white_roses_scripts' );

function white_roses_register_block_styles() {
	register_block_style('core/media-text',
		array(
			'name'	=> 'menu-and-image',
			'label'	=>	__( 'Menu and Image' ),
		),
	);
	register_block_style('core/heading',
		array(
			'name'	=>	'rotated-heading',
			'label'	=>	__( 'Rotated Heading' ),
		),
	);
	register_block_style('core/button',
		array(
			'name'	=>	'primary-button',
			'label'	=>	__('Primary Button'),
			'default'	=>	true,
		),
	);
}

add_action( 'init', 'white_roses_register_block_styles' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include custom shortcodes.php file
 */

require get_template_directory() . '/shortcodes/shortcodes.php';
