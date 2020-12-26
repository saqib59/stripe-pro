 (function($){
// console.log(object96.pk_stripe_pro);
    if (object96.pk_stripe_pro == '') {
      var stripe = Stripe('pk_test_1JuvkUR59bbgIbN9y2Bdb3Ot00OhFzqmQb');
    }
    else{
      var stripe = Stripe(object96.pk_stripe_pro);
    }
      var stripe = Stripe('pk_test_1JuvkUR59bbgIbN9y2Bdb3Ot00OhFzqmQb');

    
    var elements = stripe.elements();

      var style = {
        base: {
          color: '#32325d',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
            color: '#aab7c4'
          }
        },
        invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
        }
      };

    var cardNumberElement = elements.create('cardNumber', {
        style: style,
        placeholder: 'Enter card number',
    });
    cardNumberElement.mount('#card-number-element');


    var cardExpiryElement = elements.create('cardExpiry', {
        style: style,
        placeholder: 'Expiry date',
    });
    cardExpiryElement.mount('#card-expiry-element');


    var cardCvcElement = elements.create('cardCvc', {
        style: style,
        placeholder: 'CVC number',
    });
    cardCvcElement.mount('#card-cvc-element');


    function setOutcome(result) {
            var successElement = document.querySelector('.success');
            var errorElement = document.querySelector('.error');
            successElement.classList.remove('visible');
            errorElement.classList.remove('visible');

            if (result.token) {
                // In this example, we're simply displaying the token
                successElement.querySelector('.token').textContent = result.token.id;
                successElement.classList.add('visible');

                $('input[name=token]').val(result.token.id);


                success_init();

                // In a real integration, you'd submit the form with the token to your backend server
                //var form = document.querySelector('form');
                //form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
                //form.submit();
            } else if (result.error) {
                errorElement.textContent = result.error.message;
                errorElement.classList.add('visible');
            }
    }

    cardNumberElement.on('change', function(event) {
        setOutcome(event);
    });


    

        $('#stripePro').submit(function(e){
            e.preventDefault();

            // alert('working properly button');
            //alert(postal_code_value);

            stripe.createToken(cardNumberElement).then(setOutcome);

        });

        function success_init(){
            //var stripeForm = $('#stripeForm').serialize();
            event.preventDefault();
            $("#stripePro").validate();
            var stripeForm = $('#stripePro').serialize();
            var token = $('input[name=token]').val();
            var valid = $("#stripePro").valid();
            if (valid) {
            //alert(token);
            //alert(ajaxadmin.ajaxurl);
            $('button[name=pay_now]').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
            $('button[name=pay_now]').prop('disabled',true);
            //var amount = $("#otherinput").val();
            //alert(amount);    
            $.ajax({
                type: 'post',
                url: object96.ajax_url,
                data: stripeForm,
                dataType : 'json',
                success: function (response) {

                    $('.fa.fa-spinner.fa-spin').remove();
                    $('button[name=pay_now]').prop('disabled',false);
                    var error = response.error;
                    console.log(response);
                        if (error) { 
                            Swal.fire({
                                icon: 'error',
                                text: response.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                text: response.message,
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        }
                },
                error : function(errorThrown){
                    console.log(errorThrown);
                }
            });
        }

        }
})(jQuery)