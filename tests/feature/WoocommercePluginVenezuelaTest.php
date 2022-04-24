<?php

use PHPUnit\Framework\TestCase;

include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-config.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-load.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-includes/wp-db.php");
include_once("/home/jorge/Documentos/projects/wordpress-comercialgeorge/wp-content/plugins/woocomerce-plugin-venezuela/src/ActivatePlugin.php");

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
        $activatePlugin = new ActivatePlugin($this->wpdb);
        $activatePlugin->createBanks();
        $banks = $activatePlugin->getBanks();

        $this->assertEquals(23,count($banks));
    }

}