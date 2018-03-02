<?php 
class WC_Minmax_Order {

	public function __construct() {
		$this->init_hooks();
	}

	public function init_hooks() {
		$this->init_actions();
		$this->init_filters();
	}

	public function init_actions() {
		add_action( 'woocommerce_before_cart', array( $this, 'wc_minimum_order' ) );
		add_action( 'woocommerce_checkout_process', array( $this, 'wc_minimum_order' ) );
		add_action( 'woocommerce_before_cart', array( $this, 'wc_maximum_order' ) );
		add_action( 'woocommerce_checkout_process', array( $this, 'wc_maximum_order' ) );
	}

	public function wc_minimum_order() {
		$minimum_order = get_option( 'wc_minmax_order_min' );
		$notice = get_option( 'wc_minmax_order_min_notice' );

		if ( empty( $minimum_order ) ) return;

		if ( WC()->cart->total > $minimum_order ) return;

		$notice = str_replace( 
			array( '{amount}', '{current-amount}' ),
			array( wc_price( $minimum_order ), wc_price( wc()->cart->total ) ),
			$notice 
		);

		if ( is_cart() ) {
			wc_print_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		} else {
			wc_add_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		}
	}

	public function wc_maximum_order() {
		$maximum_order = get_option( 'wc_minmax_order_max' );
		$notice = get_option( 'wc_minmax_order_max_notice' );

		if ( empty( $maximum_order ) ) return;

		if ( WC()->cart->total < $maximum_order ) return;

		$notice = str_replace( 
			array( '{amount}', '{current-amount}' ),
			array( wc_price( $maximum_order ), wc_price( wc()->cart->total ) ),
			$notice 
		);

		if ( is_cart() ) {
			wc_print_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		} else {
			wc_add_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		}
	}

	public function init_filters() {
		//
	}
}

new WC_Minmax_Order();