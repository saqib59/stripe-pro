<?php

require_once CHI_PATH.'/inc/stripe/vendor/autoload.php';

class ajax_stripe_pro{

    function __construct(){

        add_action( "wp_ajax_form_pro_submit", array($this, 'stripe_pro_submit') );
        add_action( "wp_ajax_nopriv_form_pro_submit", array($this, 'stripe_pro_submit') );
    }
  
    function stripe_pro_submit(){
            $token = $_POST['token'];
            // $amount = get_option('amount_stripe_pro');
             $amount = $_POST['amount'];
            $sk_stripe_pro = get_option('sk_stripe_pro');
            $user_id = get_current_user_id();
            $user_info = get_userdata($user_id);
            $donated_by = $user_info->user_login;

            $donation_info = array(
                  'post_title'    =>  $donated_by.' donated',
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'post_type' => 'user_system_donation'
                );
                 
                // Insert the post into the database
            $post_id = wp_insert_post( $donation_info );
            add_post_meta($post_id,'donated_to',$_POST['donate_to']);
            add_post_meta($post_id,'donated_by',$donated_by);
             add_post_meta($post_id,'donation_amount',$amount);
            if (empty($sk_stripe_pro)) {
                \Stripe\Stripe::setApiKey('sk_test_4z8tSkEJJDNb1YygiS7rdOgg00GC48arNi');
            }
            else{
                \Stripe\Stripe::setApiKey($sk_stripe_pro);
            }
                \Stripe\Stripe::setApiKey('sk_test_4z8tSkEJJDNb1YygiS7rdOgg00GC48arNi');

            // $stripe = new \Stripe\StripeClient('sk_test_4z8tSkEJJDNb1YygiS7rdOgg00GC48arNi');

            if (!empty($token)) {

                $charge = \Stripe\Charge::create([
                  'amount' => $amount*100,
                  'currency' => 'usd',
                  // 'description' => 'Amount raised against challenge '.$post_title,
                  'source' => $token,
                  
                ]);

                // Retrieve charge details 
                $chargeJson = $charge->jsonSerialize(); 
                $transactionID = $chargeJson['balance_transaction']; 
                $payment_status = $chargeJson['status']; // succeeded

                if($payment_status == 'succeeded'){

                    $return_message = array (
                        'error' => false,
                        'message' => 'Donated successfully',
                        // 'redirect_uri' => ,
                        'transaction_id' => $transactionID 
                    );
                }
                else{
                    $return_message = array (
                        'error' => true,
                        'message' => 'Oops Something went wrong!',
                    );
                }
            }
            return $this->response_json($return_message);
    }
    function response_json($data){
        header('Content-Type: application/json');
        echo json_encode($data);
        wp_die();
    }
    function user_system_test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
new ajax_stripe_pro();
