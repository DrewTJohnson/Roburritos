jQuery(document).ready( function($) {

// Disable sortable metabox
    $('.left-cta').mouseenter(
        function() {
            $(this).next().css('flex', '0 0 25%');
            $(this).css('flex', '0 0 75%');
        }
    );
    $('.left-cta').mouseout(
        function() {
            $(this).next().css('flex', '1 0 50%');
            $(this).css('flex', '1 0 50%');
        }
    );
    $('.right-cta').mouseenter(
        function() {
            $(this).prev().css('flex', '0 0 25%');
            $(this).css('flex', '0 0 75%');
        }
    );
    $('.right-cta').mouseout(
        function() {
            $(this).prev().css('flex', '1 0 50%');
            $(this).css('flex', '1 0 50%');
        }
    );

    if( $('.woocommerce-cart-form').length ) {
        
        // woocommerce local pickup alert and shipping form removal
        if( $('input[name="shipping_method[0]"]:checked').val().includes('local') ) {
            $('.woocommerce-shipping-destination').addClass('local_pickup');
            $('.woocommerce-shipping-calculator').remove();
        }

        $('body').on('updated_shipping_method', function() {
            if( $('input[name="shipping_method[0]"]:checked').val().includes('local') ) {
                $('.woocommerce-shipping-destination').addClass('local_pickup');
                $('.woocommerce-shipping-calculator').remove();
            }
        })

        $('body').on('updated_cart_totals', function() {
            if( $('input[name="shipping_method[0]"]:checked').val().includes('local') ) {
                $('.woocommerce-shipping-destination').addClass('local_pickup');
                $('.woocommerce-shipping-calculator').remove();
            }
        })
    }

    $('body').on('init_checkout', function() {
        if( $('input[name="shipping_method[0]"]:checked').val().includes('local') ) {
            $('.local-destination').addClass('local_pickup');
        }
    })

    $('body').on('updated_checkout', function() {
        if( $('input[name="shipping_method[0]"]:checked').val().includes('local') ) {
            $('.local-destination').addClass('local_pickup');

        }
    })

    $('body').on('update_checkout', function() {
        if( $('input[name="shipping_method[0]"]:checked').val().includes('local') ) {
            $('.local-destination').addClass('local_pickup');
        }
    })


    $('button.search-toggle').on('click', function() {
        $( this ).toggleClass('search-open');
        $('form.search-form').toggleClass('open');
    })

    $('button.menu-toggle').on('click', function() {
        $('nav.mobile').toggleClass('hidden');
    })

    $('.hero-cta .cta-container a').on('mouseenter', function() {
        $('.hero-cta span').toggleClass('animate');
    })

    $('.hero-cta .cta-container a').on('mouseleave', function() {
        $('.hero-cta span').toggleClass('animate');
    })

});