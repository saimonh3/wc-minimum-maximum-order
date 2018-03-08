<?php
class WC_Minmax_Order {

	public function __construct() {
		$this->init_hooks();
	}

	public function init_hooks() {
		$this->init_actions();
		// $this->init_filters();
	}

	public function init_actions() {
		add_action( 'woocommerce_before_cart', array( $this, 'wc_minimum_order' ) );
		add_action( 'woocommerce_checkout_process', array( $this, 'wc_minimum_order' ) );
		add_action( 'woocommerce_before_cart', array( $this, 'wc_maximum_order' ) );
		add_action( 'woocommerce_checkout_process', array( $this, 'wc_maximum_order' ) );
	}

	public function wc_minimum_order() {
		$is_enabled = get_option( 'wc_minmax_order_min_enable' );
		$minimum_order = get_option( 'wc_minmax_order_min' );
		$notice = get_option( 'wc_minmax_order_min_notice' );
		$without_shipping = get_option( 'wc_minmax_order_min_shipping' );
		$without_tax = get_option( 'wc_minmax_order_min_tax' );

		if ( $is_enabled !== 'yes' || empty( $minimum_order ) ) return;

		$shipping_cost = isset( $without_shipping ) && $without_shipping == 'yes' ? WC()->cart->get_shipping_total() : '';
		$tax_cost	   = isset( $without_tax ) && $without_tax == 'yes' ? WC()->cart->get_taxes_total() : '';

		$cart_total = WC()->cart->total - ( $shipping_cost + $tax_cost );

		if ( $cart_total > $minimum_order ) return;

		$notice = str_replace(
			array( '{amount}', '{current-amount}' ),
			array( wc_price( $minimum_order ), wc_price( $cart_total ) ),
			$notice
		);

		if ( is_cart() ) {
			wc_print_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		} else {
			wc_add_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		}
	}

	public function wc_maximum_order() {
		$is_enabled = get_option( 'wc_minmax_order_max_enable' );
		$maximum_order = get_option( 'wc_minmax_order_max' );
		$notice = get_option( 'wc_minmax_order_max_notice' );
		$without_shipping = get_option( 'wc_minmax_order_max_shipping' );
		$without_tax = get_option( 'wc_minmax_order_max_tax' );

		if ( $is_enabled !== 'yes' || empty( $maximum_order ) ) return;

		$shipping_cost = isset( $without_shipping ) && $without_shipping == 'yes' ? WC()->cart->get_shipping_total() : '';
		$tax_cost	   = isset( $without_tax ) && $without_tax == 'yes' ? WC()->cart->get_taxes_total() : '';

		$cart_total = WC()->cart->total - ( $shipping_cost + $tax_cost );

		if ( $cart_total < $maximum_order ) return;

		$notice = str_replace(
			array( '{amount}', '{current-amount}' ),
			array( wc_price( $maximum_order ), wc_price( $cart_total ) ),
			$notice
		);

		if ( is_cart() ) {
			wc_print_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		} else {
			wc_add_notice( sprintf( __(  $notice , 'wcmmo' ) ), 'error' );
		}
	}

	// public function init_filters() {
	// 	//
	// }
}

new WC_Minmax_Order();
