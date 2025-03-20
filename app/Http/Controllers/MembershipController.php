<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Config;
use Redirect,Response;
use App\Http\Controllers\Controller;
use Laravel\Cashier\Cashier;
use Carbon\Carbon;
use Auth;
use Stripe;
use Session;
use Exception;

class MembershipController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
        // $this->middleware(['auth','verified']);
        // $this->middleware(['phone_verify']);
    }

    public function index(){
        $data = User::find(auth()->user()->id);
        
        $subscription = Subscription::where('user_id', auth()->user()->id)->where(function($query){
            $query->where('stripe_status', 'active')->orwhere('stripe_status', 'trialing');
        })->orderBy('id','desc')->first();
                 
         if($subscription){
            $payment = $data->defaultPaymentMethod();
            // dd($payment);
            $brand = $payment->card->brand;
            $last4 = $payment->card->last4;
             $subscribed_date = strtotime($subscription->created_at);
             $diff=time() - $subscribed_date;//time returns current time in seconds
             $days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
             $hours=round(($diff-$days*60*60*24)/(60*60));
             

            $stripe_plan = $subscription->stripe_plan;
            $membership = 'Monthly  ';
            $membership_price = '179 kr';
            $membership_period = 'month';
            
        }else{
            $membership = 'no_member';
            $membership_price = '0';
            $membership_period = '0';
            $days = 'N/A';
            $hours = 'N/A';
            $brand = 'N/A';
            $last4 = 'N/A';
        }
        return view('users.membership',compact('data','membership','membership_price','membership_period','days', 'hours','brand','last4'));
    }

    public function cancel(){
        $user = User::find(auth()->user()->id);
        $data = Subscription::where('user_id', auth()->user()->id)->where(function($query){
            $query->where('stripe_status', 'active')->orwhere('stripe_status', 'trialing');
        })->orderBy('id','desc')->first();
        // To cancel immediately
        // $sub = Stripe\Subscription::retrieve($subscription_id);
        // $sub->cancel();
        
        // To cancel after current period end
        // $sub = Stripe\Subscription::update($subscription_id, [
        // 'cancel_at_period_end' => true
        // ]);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sub =  Stripe\Subscription::retrieve($data->stripe_id);
        if ($sub) {
            $sub->cancel();
            $data->delete();
            return response()->json([
                'message' => 'Membership is canceled successfully!'
            ]);
        } else {
            return response()->json([
                'message' => 'Something Went Wrong!'
            ]);
        }

    }

    public function admin_cancel($id){
        $user = User::find($id);
        $data = Subscription::where('user_id', $id)->where(function($query){
            $query->where('stripe_status', 'active')->orwhere('stripe_status', 'trialing');
        })->orderBy('id','desc')->first();
        // To cancel immediately
        // $sub = Stripe\Subscription::retrieve($subscription_id);
        // $sub->cancel();
        
        // To cancel after current period end
        // $sub = Stripe\Subscription::update($subscription_id, [
        // 'cancel_at_period_end' => true
        // ]);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sub =  Stripe\Subscription::retrieve($data->stripe_id);
        if ($sub) {
            $sub->cancel();
            $data->delete();
            return redirect()->back()->with('success', 'New User is added successfully!');

        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function order(Request $request){

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

            $user->newSubscription('test',$input['plane'])->trialDays(30)

                ->create($paymentMethod, [

                'email' => $user->email,
            ]);


            return back()->with('success','Subscription is completed.');

        } catch (Exception $e) {

            return back()->with('success',$e->getMessage());

        }
    }

 
}