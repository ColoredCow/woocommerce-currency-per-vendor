<?php
/**
 * Plugin Name: WooCommerce Currency Per Vendor
 * Plugin URI: https://github.com/coloredcow-admin/webmentor4you-institute-website
 * Description: Specify currency per vendor.
 * Version: 0.0.1
 * Author: ColoredCow
 * Author URI: https://coloredcow.com
 * Text Domain: woocommerce-currency-per-vendor
 *
 * @package WooCommerce_Currency_Per_Vendor
 */

defined( 'ABSPATH' ) || exit;

// Define WCPV_PLUGIN_FILE.
if ( ! defined( 'WCPV_PLUGIN_FILE' ) ) {
	define( 'WCPV_PLUGIN_FILE', __FILE__ );
}

// Include the main WooCommerce_Currency_Per_Vendor class.
if ( ! class_exists( 'WooCommerce_Currency_Per_Vendor' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-woocommerce-currency-per-vendor.php';
}

/**
 * Returns the main instance of WCPV.
 *
 * @since  1.0.0
 * @return WooCommerce_Currency_Per_Vendor
 */
function WCPV() {
	return WooCommerce_Currency_Per_Vendor::instance();
}

WCPV();
