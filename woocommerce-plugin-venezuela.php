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


//SE INICIALIZA PLUGIN CON DATOS QUE DEBEN ESTAR DISPONIBLES EN BASE DE DATOS (BANCOS)
require_once plugin_dir_path(__FILE__) . "/src/ActivatePlugin.php";


function plugin_init(){

    global $wpdb;
    ActivatePlugin::$wpdb = $wpdb;
    ActivatePlugin::createBanks();

}
register_activation_hook(__FILE__,"plugin_init");

add_filter( 'woocommerce_payment_gateways', 'test_add_gateway_class' );
function test_add_gateway_class( $gateways ) {
    //$gateways[] = 'WC_Test_Gateway'; // your class name is here
    $gateways[] = 'WC_Pago_Movil_Venezuela';
    $gateways[] = 'WC_Transferencias_Venezuela';
    $gateways[] = 'WC_Zelle_Venezuela';

    return $gateways;
}

add_action( 'plugins_loaded', 'init_gateway_class' );
function init_gateway_class() {

    //require_once plugin_dir_path( __FILE__ ) . '/src/WC_Test_Gateway.php';
    require_once plugin_dir_path( __FILE__ ) . '/src/WC_Pago_Movil_Venezuela.php';
    require_once plugin_dir_path(__FILE__) . "/src/WC_Transferencias_Venezuela.php";
    require_once plugin_dir_path(__FILE__) . "/src/WC_Zelle_Venezuela.php";
}