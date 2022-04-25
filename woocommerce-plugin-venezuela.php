<?php
/*
Plugin Name: Woocommerce Plugin Venezuela
Plugin URI: https://www.jorgelbou-saad.com
Description: Plugin para registrar pagos de pedidos con Bolivares a traves de Pago movil, transferencias bancarias y zelle
Version: 1.0.o
Author: Jorge Luis Bou-saad
Author URI: https://www.jorgelbou-saad.com
License: GPLv2
*/

add_filter( 'woocommerce_payment_gateways', 'test_add_gateway_class' );
function test_add_gateway_class( $gateways ) {
    $gateways[] = 'WC_Test_Gateway'; // your class name is here
    return $gateways;
}


add_action( 'plugins_loaded', 'test_init_gateway_class' );
function test_init_gateway_class() {

    require_once plugin_dir_path( __FILE__ ) . '/src/WC_Test_Gateway.php';
}