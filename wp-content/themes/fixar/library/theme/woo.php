<?php

/********** WOOCOMERCE **********/

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 18);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20);


add_filter( 'woocommerce_show_page_title' , 'fixar_woo_hide_page_title' );
function fixar_woo_hide_page_title() {
	return false;
}

add_action( 'woocommerce_before_shop_loop_item_title', 'fixar_woo_shop_loop_item_overlay_begin', 16);
function fixar_woo_shop_loop_item_overlay_begin() {
	echo '<a class="woo-item-overlay-grid" href="' . get_the_permalink() . '">';
};

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_shop_loop_item_title_overlay', 17);
function woocommerce_shop_loop_item_title_overlay() {
	echo '<span class="product-name">' . get_the_title() . '</span>';
};

add_action( 'woocommerce_before_shop_loop_item_title', 'fixar_woo_shop_loop_item_link_close', 19);
function fixar_woo_shop_loop_item_link_close() {
	echo '</a>';
};



add_action( 'woocommerce_shop_loop_item_title', 'fixar_woo_shop_loop_item_title_open', 5);
function fixar_woo_shop_loop_item_title_open() {
	echo '<div class="woo-item-footer">';
};

add_action( 'woocommerce_shop_loop_item_title', 'fixar_woo_shop_loop_item_title', 10);
function fixar_woo_shop_loop_item_title() {
	echo '<div class="product-name"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
};

add_action( 'woocommerce_after_shop_loop_item_title', 'fixar_woo_shop_loop_item_title_close', 15);
function fixar_woo_shop_loop_item_title_close() {
	echo '</div>';
};

// add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.fixar_get_option('fixar_products_per_page','9').';' ), 20 );

add_filter( 'loop_shop_per_page', function($cols){return fixar_get_option('fixar_products_per_page','9');}, 20 );



add_filter('loop_shop_columns', 'fixar_loop_columns');
if (!function_exists('fixar_loop_columns')) {
	function fixar_loop_columns() {
		return 3; // 3 products per row
	}
}


add_filter( 'woocommerce_output_related_products_args', 'fixar_related_products_args' );
function fixar_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}


if (fixar_get_option('shop_settings_checkout') == 'on'){
	add_filter ('woocommerce_add_to_cart_redirect', 'fixar_woo_redirect_to_checkout');
}
function fixar_woo_redirect_to_checkout() {
	$checkout_url = WC()->cart->get_checkout_url();
	return $checkout_url;
}


function fixar_is_woo_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}

if(!function_exists('fixar_a_woo_cart_contents')) {

    function fixar_a_woo_cart_contents() {
        global $woocommerce;
        if(function_exists('wc_get_cart_url')) {
            $href = wc_get_cart_url();
        } else {
            $href = $woocommerce->cart->get_cart_url();
        }

        $html = $title = '';

        $items_count = $woocommerce->cart->cart_contents_count;



        if($items_count != 0){
            $count = '<span class="fl--woo-cart-details">'.$items_count.'</span>';
        } else{
            $count = '';
        }

        $html .= '<a class="fl-woo-cart-contents" href="'. esc_url($href) .'" title="'. esc_attr($title) .'">';
        $html .= '<span class="fl--woo-cart-items">';
        $html .= '<i class="theme-fonts-ShoppingCart"></i>';
        $html .= '</span>';
        $html .= $count;
        $html .= '</a>';

        return $html;
    }
}

if(!function_exists('fixar_woocommerce_total_cart')) {

    function fixar_woocommerce_total_cart($simple = false) {
        if (!class_exists('WooCommerce')) {
            return;
        }

        $html = '';

        $html .= '<div class="fl-cart--header header-icon">';
        $html .= fixar_a_woo_cart_contents();
        $html .= '</div>';

        return $html;
    }
}