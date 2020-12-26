<?php
do_action( 'lms_scripts'); 
if (!empty($_POST)) {
  if (isset($_POST['save_details'])) {
      update_option('pk_stripe_pro', $_POST['pk_stripe_pro']);
      update_option('sk_stripe_pro', $_POST['sk_stripe_pro']);
      update_option('amount_stripe_pro', $_POST['amount_stripe_pro']);
      echo '<div class="notice notice-success is-dismissible"><p>Record updated!</p></div>';  
  }

}
?>

<div class="row">
  <div class="col-sm-11">

<div class="card">
  <div class="card-header">
  <h3>Stripe Pro</h3>
  <p>Enter Stripe Credentials</p>
  </div>
  <div class="card-body">
   <form accept="" method="POST">
  <div class="form-group row">
    <label for="pk_stripe_pro" class="col-sm-2 col-form-label">Live Publishable Key:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pk_stripe_pro"  name="pk_stripe_pro" placeholder="" value="<?php echo get_option('pk_stripe_pro'); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="sk_stripe_pro" class="col-sm-2 col-form-label">Live Secret Key:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="sk_stripe_pro" name="sk_stripe_pro" value="<?php echo get_option('sk_stripe_pro'); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="amount_stripe_pro" class="col-sm-2 col-form-label">Amount:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="amount_stripe_pro" name="amount_stripe_pro" value="<?php echo get_option('amount_stripe_pro'); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="update_login96" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
      <button type="submit" id="update_login96" name="save_details" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>

  </div>
</div>
  </div>
</div>
