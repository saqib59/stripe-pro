<?php
ini_set('max_execution_time', 0);

class LoginRegister96{

    function __construct(){
        add_action( 'wp_enqueue_scripts', array($this , 'stripe_pro_scripts') );
        add_action('admin_enqueue_scripts',array($this, 'stripe_pro_scripts'));
        add_shortcode('stripe_pro',array($this, 'stripepro_form'));
        
  }
  public function stripe_pro_scripts(){

    wp_enqueue_script( 'select2js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js','','',true);
    wp_enqueue_style( 'select2css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css');
    wp_enqueue_style( 'custom-style', CHI_URL.'/assets/css/custom-style.css');
    wp_enqueue_script( 'sweet-alert', 'https://cdn.jsdelivr.net/npm/sweetalert2@9','','',true);
    wp_enqueue_script( 'jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js','','',true);
    // wp_enqueue_script('stripe-init','https://js.stripe.com/v3/','','',true);
    wp_enqueue_script( 'main-script96', CHI_URL.'/assets/js/main-script.js', '', '', true );
    wp_localize_script('main-script96', 'object96',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'pk_stripe_pro' => get_option('pk_stripe_pro')
        )
    );
    ?>
    <?php

  }

  public function stripepro_form(){
    include CHI_PATH.'/templates/form_frontend.php';
  }

}
$LoginRegister96 = new LoginRegister96();