<?php 
/**
* Plugin Name: WC Minimum Maximum Order
* Description: A simple plugin to set minimum or maximum order
* Author: Mohammed Saimon
* Author URI: http://saimon.info
* Version: 1.0
* Tested up to: 4.3
* Requires PHP: 5.6
* Text Domain: wcmmo
* License: GPLv3 or Later License
**/

if ( ! defined( 'ABSPATH' ) ) exit;

final class WC_Minimum_Maximum_Order {
	protected $version = 1.0;
	private static $instance;

	public function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_activation_hook( __FILE__, array( $this, 'deactivate' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
	}

	public function define_constants() {
		define( 'WC_MINMAX_ORDER_DIR', plugin_dir_path( __FILE__ ) );
	}

	// public function init_hooks() {
	// 	$this->init_actions();
	// 	$this->init_filters();
	// }

	// public function init_actions() {
	// 	if ( $this->is_request( 'admin' ) ) {
	// 		//
	// 	}

	// 	if ( $this->is_request( 'public' ) ) {

	// 	}
	// }

	// public function init_filters() {
	// 	if ( $this->is_request( 'admin' ) ) {
	// 		//
	// 	}

	// 	if ( $this->is_request( 'public' ) ) {
	// 		//
	// 	}
	// }

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
		// require_once WC_MINMAX_ORDER_DIR . '/includes/functions.php';

		if ( $this->is_request( 'admin' ) ) {
			require_once WC_MINMAX_ORDER_DIR . '/includes/admin/wc-minmax-settings-class.php';
		}

		if ( $this->is_request( 'public' ) ) {
			require_once WC_MINMAX_ORDER_DIR . '/includes/public/wc-minmax-order-class.php';
		}
	}

	public function init_plugin() {
		$this->includes();
		// $this->init_hooks();
	}

	public function activate() {
		//
	}

	public function deactivate() {
		//
	}

}

$WC_Minimum_Maximum_Order = WC_Minimum_Maximum_Order::init();