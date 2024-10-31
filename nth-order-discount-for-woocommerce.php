<?php
/**
 * Plugin Name: Nth Order Discount for WooCommerce
 * Plugin URI:  https://milandinic.com/wordpress/plugins/nth-order-discount-for-woocommerce/
 * Description: Automatic discounts after every nth order
 * Author:      Milan Dinić
 * Author URI:  https://milandinic.com/
 * Version:     1.0.0
 * Text Domain: nth-order-discount-for-woocommerce
 * Domain Path: /languages/
 * License:     GPL
 *
 * WC requires at least: 3.1
 * WC tested up to: 3.5
 *
 * @package NthOrderDiscount
 * @since 1.0.0
 */

// Check minimum required PHP version.
if ( version_compare( phpversion(), '5.4.0', '<' ) ) {
	return;
}

/**
 * Autoloader for Nth Order Discount for WooCommerce classes.
 *
 * @param string $class Name of the class.
 */
function nth_order_discount_autoloader( $class ) {
	$pairs = [
		'dimadin\WP\Plugin\WC\NthOrderDiscount\Coupon'                 => '/inc/Coupon.php',
		'dimadin\WP\Plugin\WC\NthOrderDiscount\Main'                   => '/inc/Main.php',
		'dimadin\WP\Plugin\WC\NthOrderDiscount\Singleton'              => '/inc/Singleton.php',
		'dimadin\WP\Plugin\WC\NthOrderDiscount\Admin\Notices'          => '/inc/Admin/Notices.php',
		'dimadin\WP\Plugin\WC\NthOrderDiscount\Admin\PluginActionLink' => '/inc/Admin/PluginActionLink.php',
		'dimadin\WP\Plugin\WC\NthOrderDiscount\Settings\Get'           => '/inc/Settings/Get.php',
		'dimadin\WP\Plugin\WC\NthOrderDiscount\Settings\Page'          => '/inc/Settings/Page.php',
	];

	if ( array_key_exists( $class, $pairs ) ) {
		include __DIR__ . $pairs[ $class ];
	}
}
spl_autoload_register( 'nth_order_discount_autoloader' );

/*
 * Initialize a plugin.
 *
 * Load class when all plugins are loaded
 * so that other plugins can overwrite it.
 */
add_action( 'plugins_loaded', [ 'dimadin\WP\Plugin\WC\NthOrderDiscount\Main', 'get_instance' ], 10 );
