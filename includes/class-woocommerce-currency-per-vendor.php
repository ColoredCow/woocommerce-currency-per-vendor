<?php
/**
 * WooCommerce Currency Per Vendor setup
 *
 * @package WooCommerce_Currency_Per_Vendor
 * @since   0.0.1
 */

defined( 'ABSPATH' ) || exit;

final class WooCommerce_Currency_Per_Vendor {
	/**
	 * WooCommerce_Currency_Per_Vendor version.
	 *
	 * @var string
	 */
	public $version = '0.0.1';

	/**
	 * The single instance of the class.
	 *
	 * @var WooCommerce_Currency_Per_Vendor
	 * @since 0.0.1
	 */
	protected static $_instance = null;

	/**
	 * Main WooCommerce_Currency_Per_Vendor Instance.
	 *
	 * Ensures only one instance of WooCommerce_Currency_Per_Vendor is loaded or can be loaded.
	 *
	 * @since 0.0.1
	 * @static
	 * @return WooCommerce_Currency_Per_Vendor - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * WooCommerce_Currency_Per_Vendor Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->load_dependencies();
		$this->init_hooks();
	}

	/**
	 * Define WCPV Constants.
	 */
	private function define_constants() {
		$this->define( 'WCPV_ABSPATH', dirname( WCPV_PLUGIN_FILE ) . '/' );
		$this->define( 'WCPV_PLUGIN_BASENAME', plugin_basename( WCPV_PLUGIN_FILE ) );
		$this->define( 'WCPV_VERSION', $this->version );
	}

	private function load_dependencies() {
		include_once WCPV_ABSPATH . 'includes/wcpv-functions.php';
	}

	private function init_hooks() {
		add_filter( 'woocommerce_add_cart_item_data',         __CLASS__ . '::add_cart_item_data',         99, 2 );
		add_filter( 'woocommerce_add_cart_item',              __CLASS__ . '::add_cart_item',              99, 2 );
		add_filter( 'woocommerce_get_cart_item_from_session', __CLASS__ . '::get_cart_item_from_session', 99, 3 );
		add_filter( 'woocommerce_currency',                   __CLASS__ . '::change_currency_code',       99 );
	}

	public static function add_cart_item_data( $cart_item_data, $product_id ) {
		$currency = wcpv_get_product_currency( $product_id );

		if ( $currency ) {
			$cart_item_data['wcpv_currency'] = $currency;
		}

		return $cart_item_data;
	}

	public static function add_cart_item( $cart_item_data, $cart_item_key ) {
		if ( isset( $cart_item_data['wcpv_currency'] ) ) {
			$cart_item_data['data']->wcpv_currency = $cart_item_data['wcpv_currency'];
		}

		return $cart_item_data;
	}

	public static function get_cart_item_from_session( $item, $values, $key ) {
		if ( array_key_exists( 'wcpv_currency', $values ) ) {
			$item['data']->wcpv_currency = $values['wcpv_currency'];
		}

		return $item;
	}

	public static function change_currency_code( $currency ) {
		if ( wcpv_is_cart_or_checkout() ) {
			if ( false != ( $_currency = wcpv_get_cart_checkout_currency() ) ) {
				return $_currency;
			}
		} elseif ( false != ( $_currency = wcpv_get_current_product_currency() ) ) {
			return $_currency;
		}

		return $currency;
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
}
