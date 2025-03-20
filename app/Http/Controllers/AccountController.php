<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Config;
use Redirect,Response;
use App\Http\Controllers\Controller;
use Laravel\Cashier\Cashier;
use Twilio\Rest\Client;
use Stripe;
use Session;
use Exception;
use Auth;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $data = User::find(auth()->user()->id);
        $countries = Country::where('status', '1')->get();
        return view('shoppers.complete_account', compact('countries','data'));
    }
 
    public function membership_view(){
        $data = User::find(auth()->user()->id);
        return view('shoppers.complete_account2', compact('data'))->with('success','Phone number verified');
    }

    public function membership(Request $request){
        $user = auth()->user();
        $input = $request->all();
        $token =  $request->stripeToken;

        $paymentMethod = $request->paymentMethod;

        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            if (is_null($user->stripe_id)) {
                $stripeCustomer = $user->createAsStripeCustomer();
            }
            \Stripe\Customer::createSource(
                $user->stripe_id,
                ['source' => $token]
            );

            $user->newSubscription('test',$input['plane'])
                ->create($paymentMethod, [
                'email' => $user->email,
            ]);
            // return back()->with('success','Subscription is completed.');
            return redirect()->route('dashboard')->with('success', 'Subscription is completed');

        } catch (Exception $e) {
            return back()->with('success',$e->getMessage());
        }
    }
}
