<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function pricing()
    {
        return view('website.pricing');
    }

    public function paymentMethod(Request $request)
    {
        return view('website.payment_method', [
            'intent' => $request->user()->createSetupIntent(),
            'plan' => $request->plan
        ]);
    }

    public function subscribe(Request $request)
    {
        $request->user()->newSubscription(
            'plan',
            $request->plan
        )->create($request->paymentMethodId);

        return redirect(route('subscribed'));
    }

    public function subscribed()
    {
        return view('website.subscribed');
    }
}
