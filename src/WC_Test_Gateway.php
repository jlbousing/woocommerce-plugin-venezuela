<?php

class WC_Test_Gateway extends WC_Payment_Gateway {

    public function __construct() {

        $this->id = "test-payment";
        $this->has_fields = true;
        $this->method_title = "Test Payments Woocommerce";
        $this->method_description = "Prueba de nuevo metodo de pago";

        $this->title = $this->get_option( 'title' );
        $this->description = $this->get_option( 'description' );
        $this->instructions = $this->get_option( 'instructions', $this->description );

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
                'title'       => 'Enable/Disable',
                'label'       => 'Enable Test Payment',
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'no'
            ),
            'title' => array(
                'title'       => 'titulo prueba',
                'type'        => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default'     => 'Credit Card',
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => 'Description',
                'type'        => 'textarea',
                'description' => 'This controls the description which the user sees during checkout.',
                'default'     => 'Pay with your credit card via our super-cool payment gateway.',
            )
        );

    }

    /**
     * You will need it if you want your custom credit card form, Step 4 is about it
     */
    public function payment_fields()
    {
        echo '<div style="display: block; width:300px; height:auto;">';
        //echo '<img src="' . plugins_url('../assets/icon.png', __FILE__ ) . '">';


        woocommerce_form_field(
            'payment_number',
            array(
                'type' => 'text',
                'label' =>__( 'numero de referencia', 'payleo-payments-woo' ),
                'class' => array( 'form-row', 'form-row-wide' ),
                'required' => true,
            )
        );

        woocommerce_form_field(
            'bank',
            array(
                'type' => 'select',
                'label' => __( 'Payment Network', 'banco' ),
                'class' => array( 'form-row', 'form-row-wide' ),
                'required' => true,
                'options' => array(
                    'none' => __( 'Select Phone Network', 'payleo-payments-woo' ),
                    'mtn_mobile' => __( 'MTN Mobile Money', 'payleo-payments-woo' ),
                    'airtel_money' => __( 'Airtel Money', 'payleo-payments-woo' ),
                ),
            )
        );

        echo '</div>';


    }

    public function save_order_payment_type_meta_data( $order, $data ) {
        if ( $data['payment_method'] === $this->id && isset($_POST['bank']) ){
            $order->update_meta_data('_banco', esc_attr($_POST['bank']) );
        }

        if( $data["payment_method"] === $this->id && isset($_POST["payment_number"])){
            $order->update_meta_data("_payment_number",esc_attr($_POST["payment_number"]));
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