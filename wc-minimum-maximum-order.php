<?php
/**
* Plugin Name: WC Minimum Maximum Order
* Description: A simple plugin to set minimum or maximum order
* Author: Mohammed Saimon
* Author URI: http://saimon.info
* Version: 1.0
* Tested up to: 4.9.4
* Requires PHP: 5.6
* Text Domain: wcmmo
* License: GPLv2 or later
**/

if ( ! defined( 'ABSPATH' ) ) exit;

final class WC_Minimum_Maximum_Order {
	protected $version = 1.0;
	private static $instance;

	public function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
	}

	public function define_constants() {
		define( 'WC_MINMAX_ORDER_DIR', plugin_dir_path( __FILE__ ) );
	}

	public function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();

			case 'ajax':
				return defined( 'DOING_AJAX' );

			case 'public':
				return ! is_admin() || ! defined( 'DOING_AJAX' );
		}
	}

	public static function init() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new WC_Minimum_Maximum_Order;
		}

		return self::$instance;
	}

	public function includes() {
		if ( $this->is_request( 'admin' ) ) {
			require_once WC_MINMAX_ORDER_DIR . '/includes/admin/wc-minmax-settings-class.php';
		}

		if ( $this->is_request( 'public' ) ) {
			require_once WC_MINMAX_ORDER_DIR . '/includes/public/wc-minmax-order-class.php';
		}
	}

	public function init_plugin() {
		$this->includes();
	}

	public function activate() {
    	if ( ! function_exists( 'WC' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            deactivate_plugins( plugin_basename( __FILE__ ) );

            wp_die( '<div class="error"><p>' . sprintf( __( '<b>WC Minimum Maximum Order</b> requires %sWooCommerce%s to be installed & activated!', 'dokan-lite' ), '<a target="_blank" href="https://wordpress.org/plugins/woocommerce/">', '</a>' ) . '</p></div>' );
        }
	}

	public function deactivate() {
		//
	}

}

$WC_Minimum_Maximum_Order = WC_Minimum_Maximum_Order::init();
