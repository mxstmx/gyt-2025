<?php
/**
 * Manage admin hooks
 *
 * @package EventinPro/Admin
 */
namespace EventinPro\Admin;

use EventinPro\Integrations\Paypal\PaypalPayment;

class PaypalOrder {
    /**
     * Constructor for the class
     *
     * @return  void
     */
    public function __construct() {
        add_action( 'eventin_order_completed', [ $this, 'paypal_order_completed' ] );
    }

    /**
     * Complete paypal order
     *
     * @param   OrderModel  $order
     *
     * @return  void
     */
    public function paypal_order_completed( $order ) {
        if ( 'paypal' !== $order->payment_method ) {
            return;
        }

        $paypal_payment = new PaypalPayment();
        $paypal_payment->complete_order( $order );
    }
}
