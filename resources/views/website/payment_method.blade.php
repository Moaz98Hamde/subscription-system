@extends('layouts.website.master', ['page' => 'Payment method'])

@push('styles')
    <style>
        #card-element {
            font-size: 14px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            color: #131e22;
            font-weight: 400;
            height: 45px;
            border-color: #d4d4d4;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            margin: 1rem 0;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6 mx-auto text-center">
            <input type="hidden" id="plan" value="{{ $plan }}">
            <input id="card-holder-name" type="text" placeholder="Card holder name">

            <div id="card-element"></div>

            <button id="card-button" data-secret="{{ $intent->client_secret }}">
                Pay now
            </button>
        </div>

        <form id="paymentForm" action="{{ route('subscribe') }}" method="POST" hidden>
            @csrf
            <input type="hidden" name="plan">
            <input type="hidden" name="paymentMethodId">
        </form>

    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');
        </script>

        <script>
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const plan = document.getElementById('plan');
            const clientSecret = cardButton.dataset.secret;

            cardHolderName.classList.add("form-control");
            cardButton.classList.add("btn")
            cardButton.classList.add("btn-primary")

            cardButton.addEventListener('click', async (e) => {
                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: cardHolderName.value
                            }
                        }
                    }
                );

                if (error) {
                    console.log(error.message);
                    // Display "error.message" to the user...
                } else {
                    // The card has been verified successfully...
                    $("input[name='plan']").val(plan.value)
                    $("input[name='paymentMethodId']").val(setupIntent.payment_method)
                    $("#paymentForm").submit();
                }
            });
        </script>
    @endpush
@endsection
