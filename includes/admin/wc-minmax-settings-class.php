<?php 

class WC_Minmax_Settings {

	public function __construct() {
		$this->init_hooks();
	}

	public function init_hooks() {
		$this->init_actions();
		$this->init_filters();
	}

	public function init_actions() {

	}

	public function init_filters() {
		add_filter( 'woocommerce_get_settings_general', array( $this, 'wc_minmax_order_settings_register' ), 99 );
	}

	public function wc_minmax_order_settings_register( $settings ) {
		$wc_minmax_settings = array(
			array(
				'title'    => __( 'WC Minimum Maximum Order', 'wcmmo' ),
				'desc'     => __( 'Set all the settings for minimum and maximum order.', 'wcmmo' ),
				'id'       => 'wc_minmax_order_settings',
				'type'     => 'title',
			),
			array(
				'title'    => __( 'Minimum Order Amout', 'wcmmo' ),
				'desc'     => __( 'Set the minimum order amount.', 'wcmmo' ),
				'id'       => 'wc_minmax_order_min',
				'type'     => 'text',
				'css'	   => 'width: 50px',
				'desc_tip' => true,
			),
			array(
				'title'    => __( 'Maximum Order Amout', 'wcmmo' ),
				'desc'     => __( 'Set the maximum order amount.', 'wcmmo' ),
				'id'       => 'wc_minmax_order_max',
				'type'     => 'text',
				'css'	   => 'width: 50px',
				'desc_tip' => true,
			),
			array( 'type' => 'sectionend', 'id' => 'wc_minmax_order_settings' ),

		);

		return array_merge( $settings, $wc_minmax_settings );
	}

}

new WC_Minmax_Settings();