<?php

defined( 'ABSPATH' ) || exit;

/**
 * Get the currency for the product, from the currency set by the product vendor.
 *
 * @param  int $product_id
 * @return string
 */
function wcpv_get_product_currency( $product_id ) {
	if ( function_exists( 'wcfm_get_vendor_id_by_post' ) ) {
		$vendor_id    = wcfm_get_vendor_id_by_post( $product_id );
	} else {
		$product_post = get_post( $product_id );
		$vendor_id    = $product_post->post_author;
	}

	return get_the_author_meta( '_wcpv_currency', $vendor_id );
}

/**
 * Is cart or checkout.
 *
 * @return bool
 */
function wcpv_is_cart_or_checkout() {
	return ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) );
}

/**
 * Get currency for cart and checkout.
 *
 * @return bool
 */
function wcpv_get_cart_checkout_currency() {
	if ( ! isset( WC()->cart ) || WC()->cart->is_empty() ) {
		return false;
	}

	$cart_items = WC()->cart->get_cart();

	foreach ( $cart_items as $cart_item ) {
		return ( isset( $cart_item['wcpv_currency'] ) ) ? $cart_item['wcpv_currency'] : false;
	}
}

/**
 * Get currency for the current product.
 *
 * For use in product loop and product single page.
 *
 * @return string
 */
function wcpv_get_current_product_currency() {
	global $product;

	if ( ! is_object( $product ) ) {
		return false;
	}

	return wcpv_get_product_currency( $product->get_id() );
}
