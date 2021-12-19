@extends('front/layout/registerLayout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('container')

<div class="register_page">
      <div class="container">
          <div class="main_panel mt-3" >
            <div class="row g-0 p-2">
                <!-- LEFT PANEL -->
                <div class="col-md-5 left_panel">
                    <h3>Lorem ipsum dolor sit amet, consetutur sadiscing slitr, sed diam noumy eirmod tempor invidunt ut.</h3>
                </div>

                <!-- RIGHT PANEL -->
                <div class="col-md-7 right_panel">
                    <div class="inner_panel pt-5" style="min-height:500px">
                          <div class="row top_panel pb-4">
                            <div class="col">
                                {{-- <a href="#" class="grey"><i class="bi bi-arrow-left"></i> {{__('Back')}}</a> --}}
                            </div>
                            <div class="col text-end">
                                Final Step
                            </div>
                         </div>
                          <div class="max_width">
                            
                          @if ($errors->any())
                              @foreach ($errors->all() as $error)
                                  <div><small class="text-danger">{{$error}}</small></div>
                              @endforeach
                          @endif
                            <h3>{{__('Register to Dierenplaats')}}</h3>
                            <p>Heb je al een account bij ons? <a href="#" class="red"><strong>Log hier in</strong></a></p>
                           
                            <form action="{{route('order-subscription_local')}}" method="post" class="digit-group" id="payment-form" data-autosubmit="false" autocomplete="off" data-parsley-validate="" novalidate="">
                            @csrf
                              <div class="mb-3 mt-4">
                                <p>Please enter card details to subscribe.</p>
                              </div>
                            
                        

                        <div class="col-md-12">

                            <div class="form-group">

                                <div id="card-element"></div>
                                
                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <div id="iban-element"></div>
                                
                            </div>

                        </div>


                              <div class="d-grid mt-5">
                                <button id="card-button" class="btn btn-primary btn-lg">Proceed To Subscribe</button>
                              </div>
                             
                            </form>
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>
@endsection
@section( 'optional_scripts' )

   <script>

        window.ParsleyConfig = {

            errorsWrapper: '<div></div>',

            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',

            errorClass: 'has-error',

            successClass: 'has-success'

        };

    </script>

    

    <script src="http://parsleyjs.org/dist/parsley.js"></script>

    

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script src="https://js.stripe.com/v3/"></script>

    <script>

        var style = {

            base: {

                color: '#32325d',

                lineHeight: '18px',

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


        const stripe = Stripe('{{ env("STRIPE_KEY") }}', { locale: 'en' }); // Create a Stripe client.

        const elements = stripe.elements(); // Create an instance of Elements.

        const card = elements.create('card', { style: style }); // Create an instance of the card Element.


        card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.


        card.on('change', function(event) {

            var displayError = document.getElementById('card-errors');

            if (event.error) {

                displayError.textContent = event.error.message;

            } else {

                displayError.textContent = '';

            }

        });

        var options = {  
                supportedCountries: ['SEPA'],  
                placeholderCountry: 'IN',  
                };  
      // Create an instance of the IBAN Element  
      var iban = elements.create('iban', options);  
      
      // Add an instance of the IBAN Element into the `iban-element` <div>  
      iban.mount('#iban-element');  

        // Handle form submission.

        var form = document.getElementById('payment-form');



        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {

            event.preventDefault();


            stripe.createToken(card).then(function(result) {

                if (result.error) {

                    // Inform the user if there was an error.

                    var errorElement = document.getElementById('card-errors');

                    errorElement.textContent = result.error.message;

                } else {

                    // Send the token to your server.

                    stripeTokenHandler(result.token);

                }

            });

        });


        // Submit the form with the token ID.

        function stripeTokenHandler(token) {

            // Insert the token ID into the form so it gets submitted to the server

            var form = document.getElementById('payment-form');

            var hiddenInput = document.createElement('input');

            hiddenInput.setAttribute('type', 'hidden');

            hiddenInput.setAttribute('name', 'stripeToken');

            hiddenInput.setAttribute('value', token.id);

            form.appendChild(hiddenInput);


            // Submit the form

            form.submit();

        }

    </script>
@endsection