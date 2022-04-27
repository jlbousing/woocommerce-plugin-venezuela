<?php

include_once ("ActivatePlugin.php");
class WC_Zelle_Venezuela extends WC_Payment_Gateway
{

    public function __construct() {

        $this->id = "zelle";
        $this->has_fields = true;
        $this->method_title = "Zelle Woocommerce";
        $this->method_description = "Registro de transferencias con Zelle para Woocommerce";

        $this->title = "Pago con Zelle";
        $this->description = "Registro de comprobante para transferencias con Zelle";
        $this->instructions = "Ingrese en el formulario el email con que se hizo la transferencia, el monto total
                               y fecha en la que se hizo la transferencia";

        $this->init_form_fields();
        $this->init_settings();

        //HOOK PARA GUARDAR LOS CAMBIOS EN LAS CONFIGURACIONES
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        add_action( 'woocommerce_checkout_create_order', array( $this, 'save_order_payment_type_meta_data' ), 10, 2 );
    }

    /**
     * Plugin options, we deal with it in Step 3 too
     */
    public function init_form_fields(){

        $this->form_fields = array(
            'enabled' => array(
                'title'       => 'Activar/Desactivar',
                'label'       => 'Activar registro de transferencias de banca nacional',
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'no'
            )
        );

    }

    /**
     * You will need it if you want your custom credit card form, Step 4 is about it
     */

    public function payment_fields()
    {
        echo $this->instructions;
        echo '<div style="display: block; width:300px; height:auto;">';
        //echo '<img src="' . plugins_url('../assets/icon.png', __FILE__ ) . '">';


        woocommerce_form_field(
            'email',
            array(
                'type' => 'text',
                'label' =>__( 'Email', 'numero_referencia' ),
                'class' => array( 'form-row', 'form-row-wide' ),
                'required' => true,
            )
        );

        woocommerce_form_field(
            'amount',
            array(
                'type' => 'number',
                'label' =>__( 'Monto', 'numero_referencia' ),
                'class' => array( 'form-row', 'form-row-wide' ),
                'required' => true,
            )
        );

        woocommerce_form_field(
            'date',
            array(
                'type' => 'text',
                'label' =>__( 'Fecha de transferencia', 'numero_referencia' ),
                'class' => array( 'form-row', 'form-row-wide' ),
                'required' => true,
            )
        );

        echo '</div>';


    }

    public function save_order_payment_type_meta_data( $order, $data ) {
        if ( $data['payment_method'] === $this->id && isset($_POST['email']) ){
            $order->update_meta_data('_email_client', esc_attr($_POST['email']) );
        }

        if( $data["payment_method"] === $this->id && isset($_POST["amount"])){
            $order->update_meta_data("_amount",esc_attr($_POST["amount"]));
        }

        if( $data["payment_method"] === $this->id && isset($_POST["date"])){
            $order->update_meta_data("_date",esc_attr($_POST["date"]));
        }
    }


    /*
     * Custom CSS and JS, in most cases required only when you decided to go with a custom credit card form
     */
    public function payment_scripts() {

    }

    /*
      * Fields validation, more in Step 5
     */
    public function validate_fields() {

    }

    /*
     * We're processing the payments here, everything about it is in Step 5
     */
    public function process_payment( $order_id ) {

        global $woocommerce;
        $order = new WC_Order($order_id);

        $order->update_status('on-hold', __( 'Awaiting cheque payment', 'woocommerce' ));
        $woocommerce->cart->empty_cart();

        return array(
            'result' => 'success',
            'redirect' => $this->get_return_url( $order )
        );

    }

    /*
     * In case you need a webhook, like PayPal IPN etc
     */
    public function webhook() {

    }
}