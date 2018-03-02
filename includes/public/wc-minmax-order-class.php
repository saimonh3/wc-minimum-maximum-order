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

		if ( empty( $minimum_order ) ) return;

		if ( WC()->cart->total > $minimum_order ) return;

		if ( is_cart() ) {
			wc_print_notice(
				sprintf( 'Minimum order total is %s, your current order is %s',
					wc_price( $minimum_order ),
					wc_price( WC()->cart->total )
				), 'error'
			);
		} else {
			wc_add_notice(
				sprintf( 'Minimum order total is %s, your current order is %s', 
					wc_price( $minimum_order ),
					wc_price( WC()->cart->total )
				), 'error'
			);
		}
	}

	public function wc_maximum_order() {
		$maximum_order = get_option( 'wc_minmax_order_max' );

		if ( empty( $maximum_order ) ) return;

		if ( WC()->cart->total < $maximum_order ) return;

		if ( is_cart() ) {
			wc_print_notice(
				sprintf( __( 'Maximum order is %s, your current order total is %s',
					wc_price( $maximum_order ),
					wc_price( WC()->cart->total )
				, 'wcmmo' ) ), 'error'
			);
		} else {
			wc_add_notice(
				sprintf( __( 'Maximum order is %s, your current order is %s', 
					wc_price( $maximum_order ),
					wc_price( WC()->cart->total )
				, 'wcmmo' ) ), 'error'
			);
		}
	}

	public function init_filters() {
		//
	}
}

new WC_Minmax_Order();