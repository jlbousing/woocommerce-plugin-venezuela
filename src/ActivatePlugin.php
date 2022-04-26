<?php

class ActivatePlugin
{
    static $wpdb;

    //METODOS PARA CREAR DATOS NECESARIOS EN BASE DE DATOS
    public static function createBanks()
    {
        $wpdb = self::$wpdb;

        $sql = "DROP TABLE IF EXISTS {$wpdb->prefix}venezuelan_banks";
        $wpdb->query($sql);

        //SE CREA TABLA BANCOS
        $sql ="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}venezuelan_banks(
            `id` INT NOT NULL AUTO_INCREMENT,
            `bank_name` VARCHAR(45),
            `code` varchar(10),
            PRIMARY KEY (`id`));";
        $wpdb->query($sql);

        //SE INSERTAN BANCOS

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "MERCANTIL BANCO UNIVERSAL",
            "code" => "0105"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO DE VENEZUELA S.A BANCO UNIVERSAL",
            "code" => "0102"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "VENEZOLANO DE CREDITO, S.A. BANCO UNIVERSAL",
            "code" => "0104"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO PROVINCIAL S.A BANCO UNIVERSAL",
            "code" => "0108"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO DEL CARIBE",
            "code" => "0114"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO EXTERIOR, C.A.",
            "code" => "0115"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO OCCIDENTAL DE DESCUENTO S.A.C.A",
            "code" => "0116"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO CARONI, C.A BANCO UNIVERSAL",
            "code" => "0128"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANESCO BANCO UNIVERSAL",
            "code" => "0134"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO SOFITASA",
            "code" => "0137"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO PLAZA",
            "code" => "0138"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "FONDO COMUN, C.A BANCO UNIVERSAL",
            "code" => "0151"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "100% BANCO, BANCO UNIVERSAL C.A",
            "code" => "0156"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "DEL SUR BANCO UNIVERSAL, C.A",
            "code" => "0157"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO DEL TESORO",
            "code" => "0163"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO AGRICOLA DE VENEZUELA",
            "code" => "0166"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCRECER S.A BANCO MICROFINANCIERO",
            "code" => "0168"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "MIBANCO BANCO DE DESARROLLO",
            "code" => "0169"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO ACTIVO, C.A",
            "code" => "0171"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCAMIGA BANCO UNIVERSAL",
            "code" => "0172"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANPLUS BANCO UNIVERSAL, C.A",
            "code" => "0174"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO BICENTENARIO BANCO UNIVERSAL C.A",
            "code" => "0175"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO DE LA FUERZA ARMADA NACIONAL BOLIVARIANA",
            "code" => "0177"
        ));

        $wpdb->insert("{$wpdb->prefix}venezuelan_banks",array(
            "bank_name" => "BANCO NACIONAL DE CREDITO, C.A.",
            "code" => "0191"
        ));
    }

    public static function getBanks()
    {
        $wpdb = self::$wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}venezuelan_banks";
        $result = $wpdb->get_results($query,OBJECT);

        return $result;
    }

}