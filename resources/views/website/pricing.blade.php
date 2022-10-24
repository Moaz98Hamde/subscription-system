@extends('layouts.website.master', ['page' => 'Pricing'])

@section('content')
    <div class="container px-0">
        <div class="row">
            <div class="col-md-4 mb-30 ml-auto">
                <div class="card-box pricing-card mt-30 mb-30">
                    <div class="pricing-icon">
                        <img src="vendors/images/icon-Cash.png" alt="">
                    </div>
                    <div class="price-title">Monthly</div>
                    <div class="pricing-price"><sup>$</sup>{{ env('MONTHLY_PRICE') ?? '10' }}<sub>/mo</sub></div>
                    <div class="text">
                        Subscribe for one month
                    </div>
                    <div class="cta">
                        <a href="{{ route('payment_method', ['plan' => env('MONTHLY_SUB_ID') ?? 'price_1LwF9XI7xgQUttPqp8pok1hp']) }}"
                            class="btn btn-primary btn-rounded btn-lg">Subscribe Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-30 mr-auto">
                <div class="card-box pricing-card mt-30 mb-30">
                    <div class="pricing-icon">
                        <img src="vendors/images/icon-online-wallet.png" alt="">
                    </div>
                    <div class="price-title">Yearly</div>
                    <div class="pricing-price"><sup>$</sup>{{ env('YEARLY_PRICE') ?? '100' }}<sub>/yr</sub></div>
                    <div class="text">
                        Subscribe for one year
                    </div>
                    <div class="cta">
                        <a href="{{ route('payment_method', ['plan' => env('YEARLY_SUB_ID') ?? 'price_1LwF9XI7xgQUttPqNPgGf1up']) }}"
                            class="btn btn-primary btn-rounded btn-lg">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
