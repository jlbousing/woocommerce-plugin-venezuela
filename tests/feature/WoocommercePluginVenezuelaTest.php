<?php

use PHPUnit\Framework\TestCase;

include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-config.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-load.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-includes/wp-db.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-content/plugins/woocomerce-plugin-venezuela/src/ActivatePlugin.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-content/plugins/woocomerce-plugin-venezuela/src/WC_Transferencias_Venezuela.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-content/plugins/woocomerce-plugin-venezuela/src/WC_Pago_Movil_Venezuela.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-content/plugins/woocomerce-plugin-venezuela/src/WC_Zelle_Venezuela.php");

class WoocommercePluginVenezuelaTest extends TestCase
{

    private $wpdb;

    protected function setUp(): void
    {
        print_r("\n corriendo WooCommercePluginVenezuelaTest");
        $this->connectDB();
    }

    public function connectDB() {

        $user = "root";
        $password = "bousing";
        $host = "172.20.0.2";
        $db = "wordpresstest";

        $this->wpdb = new wpdb($user,$password,$db,$host);
    }


    public function test_create_banks()
    {
        ActivatePlugin::$wpdb = $this->wpdb;
        ActivatePlugin::createBanks();
        $banks = ActivatePlugin::getBanks();

        $this->assertEquals(23,count($banks));
    }

    public function test_init_transferencia_venezuela()
    {
        $transferencia = new WC_Transferencias_Venezuela();

        $this->assertInstanceOf(WC_Transferencias_Venezuela::class,$transferencia);
    }

    public function test_init_pago_movil_venezuela()
    {
        $pagoMovil = new WC_Pago_Movil_Venezuela();

        $this->assertInstanceOf(WC_Pago_Movil_Venezuela::class,$pagoMovil);
    }

    public function test_init_zelle()
    {
        $zelle = new WC_Zelle_Venezuela();

        $this->assertInstanceOf(WC_Zelle_Venezuela::class,$zelle);
    }



}