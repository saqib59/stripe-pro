<?php
$publishable_key = get_option('pk_stripe_pro');
// if (!empty($publishable_key)) {
?>
<style>
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number]{
    width: 100%;
    height: 40px;
}

</style>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>


<form method="post" id="stripePro">
<center><h1>Donation Form</h1>
<!-- <h3>Get in Touch With A-1 Insurance Group, Inc.</h3> -->
</center>
  <input type="hidden" name="token">
     
  <input type="hidden" name="action" value="form_pro_submit">
  <div class="group">
      <div class="col span_12">
      <lable> Donate
      <select name="donate_to" class="required">
            <option value="">:: Select user to donate ::</option>
            <?php
              $args = array(
                  'role'    => 'user_system',
              );
              $users = get_users( $args );
              foreach ( $users as $user ) {
                ?>
                <option value="<?=  $user->ID; ?>"><?=  $user->display_name; ?></option>
                <?php
              }
            ?>
          </select>
          </lable>
          </div>
    <div class="col span_12">
    <lable class="donate_amount"> Donate Amount
    <input type="number" name="amount" placeholder="Amount to donate" class="">
    </lable>
    </div>
    <div class="col span_12">
      <label>
        <span>Card number</span>
        <div id="card-number-element" class="field"></div>
      </label>
    </div>
    <div class="col span_12">
      <label>
        <span>Expiry date</span>
        <div id="card-expiry-element" class="field"></div>
      </label>
    </div>
    <div class="col span_12">
      <label>
        <span>CVC</span>
        <div id="card-cvc-element" class="field"></div>
      </label>
    </div>
  </div>
  <button type="submit" name="pay_now">Pay now!</button>
  <div class="outcome">
    <div class="error"></div>
    <div class="success" style="display: none;"> Success! Your Stripe token is <span class="token"></span></div>
  </div>
</form>
<?php
// }
// else{
//   _e( 'Stripe is not setup properly', 'stripe-pro' ); 
// }
