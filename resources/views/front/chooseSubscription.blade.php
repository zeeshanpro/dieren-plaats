<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles -->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <link href="{{ asset( $publicPath . 'front_assets/css/my.css') }}" rel="stylesheet">

    <!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    

</head>

<body id="app-layout">

<div class="container">

    <div class="row" style="margin-top: 100px;">

      <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-default credit-card-box">

            <div class="panel-heading display-table" >

                <div class="row display-tr" >

                    <h3 class="panel-title display-td" >Payment Details</h3>

                    <div class="display-td" >                            

                        <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">

                    </div>

                </div>                    

            </div>

            <div class="panel-body">

                <div class="col-md-12">

                <form action="/order-subscription" method="POST" id="subscribe-form">
                        <div class="form-group">
                            <div class="row">
                                @foreach($plans as $plan)            
                                <div class="col-md-4">                
                                    <div class="subscription-option">
                                        <input type="radio" id="plan-silver" name="plan" value='{{$plan->id}}'>
                                        <label for="plan-silver">
                                            <span class="plan-price">{{$plan->currency}}{{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>
                                            <span class="plan-name">{{$plan->product->name}}</span>
                                        </label>
                                    </div>            </div>            @endforeach        </div>
                        </div>    <input id="card-holder-name" type="text"><label for="card-holder-name">Card Holder Name</label>    @csrf
                        <div class="form-row">
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element" class="form-control">        </div>        <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="stripe-errors"></div>    
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif    <div class="form-group text-center">
                            <button  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block">{{__('SUBMIT')}}</button>
                        </div>
                </form>

                </div>

            </div>

        </div>

            

        </div>

    </div>

    

</div>

    

    <!-- PARSLEY -->

    <script src="https://js.stripe.com/v3/"></script>
    <script>    
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
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
    // var card = elements.create('card', {
    //     hidePostalCode: true,
    //     style: style
    // });
    var card = elements.create('card');
        card.mount('#card-element');    
        card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });    
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;    
    cardButton.addEventListener('click', async (e) => {
        console.log("attempting");
        const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );        
            if (error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;        
            } else {            
                paymentMethodHandler(setupIntent.payment_method);
            }
    });    
    
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);        
        form.submit();
    }
    </script>

</body>

</html>