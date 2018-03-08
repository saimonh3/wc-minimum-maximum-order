<?php

class WC_Minmax_Settings {

	public function __construct() {
		$this->init_hooks();
	}

	public function init_hooks() {
		// $this->init_actions();
		$this->init_filters();
	}

	// public function init_actions() {
	//
	// }

	public function init_filters() {
		add_filter( 'woocommerce_get_settings_general', array( $this, 'wc_minmax_order_settings_register' ), 99 );
	}

	public function wc_minmax_order_settings_register( $settings ) {
		$wc_minmax_order_settings = array(
			array(
				'title'		=> __( 'WC Minimum Maximum Order', 'wcmmo' ),
				'desc'		=> __( 'Set all the settings for minimum and maximum order.', 'wcmmo' ),
				'id'        => 'wc_minmax_order_settings',
				'type'      => 'title',
			),
			array(
				'title'     => __( 'Enable', 'wcmmo' ),
				'desc'      => __( 'Enable minimum order amount.', 'wcmmo' ),
				'id'        => 'wc_minmax_order_min_enable',
				'type'      => 'checkbox',
				'options'	=> array( 'yes' ),
				'desc_tip'  => true,
				'default'   => 'yes'
			),
			array(
				'title'     => __( 'Minimum Order Amount', 'wcmmo' ),
				'desc'      => __( 'Set the minimum order amount.', 'wcmmo' ),
				'id'        => 'wc_minmax_order_min',
				'type'      => 'text',
				'css'	    => 'width: 50px',
				'desc_tip'  => true,
			),
			array(
				'title'		=> __( 'Without Shipping Cost', 'wcmmo' ),
				'desc'		=> __( 'Calculate total order amount without the shipping cost', 'wcmmo' ),
				'id'		=> 'wc_minmax_order_min_shipping',
				'type'		=> 'checkbox',
				'options'	=> array( 'yes' ),
				'desc_tip'	=> true,
			),
			array(
				'title'		=> __( 'Without Tax', 'wcmmo' ),
				'desc'		=> __( 'Calculate total order amount without tax', 'wcmmo' ),
				'id'		=> 'wc_minmax_order_min_tax',
				'type'		=> 'checkbox',
				'options'	=> array( 'yes' ),
				'desc_tip'	=> true,
			),
			array(
				'title'     => __( 'Minimum Order Amount Notice', 'wcmmo' ),
				'desc'      => __( 'Set the minimum order amount error notice. Insert {amonut} and {current-ammonut} text where you want to show the order value in the message ', 'wcmmo' ),
				'id'        => 'wc_minmax_order_min_notice',
				'type'      => 'text',
				'default'   => 'Minimum order is {amount}, your current order total is {current-amount}',
				'desc_tip'  => true,
			),

			array(
				'title'     => __( 'Enable', 'wcmmo' ),
				'desc'      => __( 'Enable minimum order amount.', 'wcmmo' ),
				'id'        => 'wc_minmax_order_max_enable',
				'type'      => 'checkbox',
				'options'	=> array( 'yes' ),
				'desc_tip'  => true,
			),
			array(
				'title'     => __( 'Maximum Order Amount', 'wcmmo' ),
				'desc'      => __( 'Set the maximum order amount.', 'wcmmo' ),
				'id'        => 'wc_minmax_order_max',
				'type'      => 'text',
				'css'	    => 'width: 50px',
				'desc_tip'  => true,
			),
			array(
				'title'		=> __( 'Without Shipping Cost', 'wcmmo' ),
				'desc'		=> __( 'Calculate total order amount without the shipping cost', 'wcmmo' ),
				'id'		=> 'wc_minmax_order_max_shipping',
				'type'		=> 'checkbox',
				'options'	=> array( 'yes' ),
				'desc_tip'	=> true,
			),
			array(
				'title'		=> __( 'Without Tax', 'wcmmo' ),
				'desc'		=> __( 'Calculate total order amount without tax', 'wcmmo' ),
				'id'		=> 'wc_minmax_order_max_tax',
				'type'		=> 'checkbox',
				'options'	=> array( 'yes' ),
				'desc_tip'	=> true,
			),
			array(
				'title'     => __( 'Maximum Order Amount Notice', 'wcmmo' ),
				'desc'      => __( 'Set the maximum order amount error notice. Insert {amonut} and {current-ammonut} text where you want to show the order value in the message ', 'wcmmo' ),
				'id'        => 'wc_minmax_order_max_notice',
				'type'      => 'text',
				'default'   => 'Maximum order is {amount}, your current order total is {current-amount}',
				'desc_tip'  => true,
			),
			array( 'type'   => 'sectionend', 'id' => 'wc_minmax_order_settings' ),
		);

		return array_merge( $settings, apply_filters( 'wc_minmax_order_settings', $wc_minmax_order_settings ) );
	}

}

new WC_Minmax_Settings();
