<?php

function white_roses_create_shortcode_custom_post_types( $atts ) {

    $atts = shortcode_atts( array(
        'category'  =>  'main',
        'submenu'   =>  ''
    ), $atts );

    // $category = sanitize_text_field( $atts['category'] );

    $args = array(
        'post_type' =>  'robs_menu_item',
        'posts_per_page'    =>  '-1',
        'post_status'   =>  'publish',
        'tax_query' =>  array(
            'relation'  =>  'OR',
            array(
                'taxonomy'  =>  'category',
                'field' =>  'slug',
                'terms' =>  array( $atts['category'] ),
            ),
            array(
                'taxonomy'  =>  'submenu',
                'field' =>  'name',
                'terms' =>  array( $atts['submenu'] ),
            )
        ),
    );

   $query = new WP_Query( $args );

   $submenu = $atts['submenu'];

   $html = '<div class="menu__container">';
   $html .= '<h3>' . $submenu . '</h3>';
    while ( $query->have_posts() ) : $query->the_post();
        $post_id = get_the_ID();
        $title = get_the_title();
        $description = get_post_meta( $post_id, 'menu-item-description', true);
        $price = get_post_meta( $post_id, 'menu-item-price', true);

        $html .= '<div class="menu__item">';
        if ( $description )
            $html .= '<p class="menu__item-title-description">'. $title . ' - ' . $description . '</p>';
        else
            $html .= '<p class="menu__item-title-description">' . $title . '</p>';
        $html .= '<p class="menu__item-price">' . $price . '</p>';
        $html .= '</div>';

    endwhile;
    $html .= '</div>';


    wp_reset_query();

    return $html;

};

add_shortcode( 'robs_menu', 'white_roses_create_shortcode_custom_post_types' );

?>