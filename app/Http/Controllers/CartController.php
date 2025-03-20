<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Session;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Cashier;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Storage;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Stripe\PaymentIntent;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        $sek_rate = Currency::convert()->from('EUR')->to('SEK')->get();
        $nok_rate = Currency::convert()->from('EUR')->to('NOK')->get();
        return view('frontend.cart', compact('cartItems','sek_rate','nok_rate'));
    }

    public function checkout(){
        $sek_rate = Currency::convert()->from('EUR')->to('SEK')->get();
        $nok_rate = Currency::convert()->from('EUR')->to('NOK')->get();
        $cartItems = \Cart::getContent();
        return view('frontend.checkout', compact('cartItems','sek_rate','nok_rate'));
    }


    public function addToCart(Request $request)
    {   
        $product = Product::find($request->id);
        \Cart::add([
            'id' => $request->id,
            'name' => $product->name,
            'price' =>  $product->wholesalePrice,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $product->image,
                'membership' => $request->membership,
                'no_price' =>  $product->no_wholesalePrice,
                'se_price' =>  $product->se_wholesalePrice,
                'normal_price' => $product->retailPrice,
                'se_normal_price' => $product->se_retailPrice,
                'no_normal_price' => $product->se_retailPrice,
                'size' => $request->size
            )
        ]);
        session()->flash('success', 'product_added_msg');
        return redirect()->back()->with('cart', '1');
    }

    public function updateCart(Request $request){
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        return response()->json([
            'title' => 'Success!',
            'status' => 'success',
            'message' => 'Product quantity is updated!'
        ]);
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'product_removed_msg');
        $price = \Cart::getTotal();
        if($price == 0){
            return redirect()->back();
        }else{
            return redirect()->back()->with('cart', '1');
        }
    }

    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'product_cleared_msg');
        return redirect()->route('cart.list');
    }

    public function purchase_checkout(Request $request){
        // dd($request);
        Session::put('purchase_product', $request->product_id);
        Session::put('first_name', $request->first_name);
        Session::put('last_name', $request->last_name);
        Session::put('address', $request->address);
        Session::put('zipcode', $request->zipcode);
        Session::put('city', $request->city);
        Session::put('phone', $request->phone);
        Session::put('email', $request->email);
        Session::put('country', $request->country);
        return redirect()->route('purchase.payment');
    }

    public function purchase_payment(){
        $product_id = Session::get('purchase_product');
        if($product_id){
            $data = Product::find($product_id);
            if(Session::get('country') == "FR"){
                $product = [
                   "name" => $data->detail->fr_name,
                   "description" => $data->detail->fr_description
                ];
                
            }elseif(Session::get('country') == "IT"){
                $product = [
                   "name" => $data->detail->it_name,
                   "description" => $data->detail->it_description
                ];
            }elseif(Session::get('country') == "SE"){
                $product = [
                    "name" => $data->detail->sv_name,
                    "description" => $data->detail->sv_description
                ];
            }elseif($request->lang == "PT"){
                $product = [
                    "name" => $data->detail->pt_name,
                    "description" => $data->detail->pt_description
                ];
            }elseif($request->lang == "DK"){
                $product = [
                    "name" => $data->detail->da_name,
                    "description" => $data->detail->da_description
                ];
            }elseif($request->lang == "NL"){
                $product = [
                    "name" => $data->detail->nl_name,
                    "description" => $data->detail->nl_description
                ];
            }elseif($request->lang == "GE"){
                $product = [
                    "name" => $data->detail->ge_name,
                    "description" => $data->detail->ge_description
                ];
            }elseif($request->lang == "FI"){
                $product = [
                    "name" => $data->detail->fi_name,
                    "description" => $data->detail->fi_description
                ];
            }elseif($request->lang == "NO"){
                $product = [
                    "name" => $data->detail->no_name,
                    "description" => $data->detail->no_description
                ];
            }else{
                $product = [
                    "name" => $data->name,
                    "description" => $data->description
                ];
            }
            
            return view('frontend.purchase_payment', compact('data','product'));
        }else{
            return redirect()->back();
        }
    }

    public function process_checkout(Request $request)
    {
        Session::put('first_name', $request->first_name);
        Session::put('last_name', $request->last_name);
        Session::put('address', $request->address);
        Session::put('zipcode', $request->zipcode);
        Session::put('city', $request->city);
        Session::put('phone', $request->phone);
        Session::put('email', $request->email);
        Session::put('country', $request->country);
        return redirect()->route('shipping');
    }

    public function shipping(){
        $sek_rate = Currency::convert()->from('EUR')->to('SEK')->get();
        $nok_rate = Currency::convert()->from('EUR')->to('NOK')->get();
        $cartItems = \Cart::getContent();
        return view('frontend.shipping', compact('cartItems','sek_rate','nok_rate'));
    }

    public function payment(){
        $sek_rate = Currency::convert()->from('EUR')->to('SEK')->get();
        $nok_rate = Currency::convert()->from('EUR')->to('NOK')->get();
        $cartItems = \Cart::getContent();
        return view('frontend.payment', compact('cartItems','sek_rate','nok_rate'));
    }

    public function process_payment(Request $request){
        $cartItems = \Cart::getContent();
        $price = \Cart::getTotal();

        $start = "277744987";
		$enddight = "988899934";
		$code = rand($start, $enddight);
		$token =  $request->stripeToken;
		
		$user = User::where('email', session()->get('email'))->first();
        $user_status = 'old';
		if($user == null){
            $user = new User();
            $user->username = session()->get('first_name').' '.session()->get('last_name');
            $user->email = session()->get('email');
            // $user->city = session()->get('city');
            // $user->address = session()->get('address');
            // $user->zipcode = session()->get('zipcode');
            $user->phone = session()->get('phone');
            $user->type = 2;
            $user->password=Hash::make($code);
            $user->trial_ends_at = now()->addDays(7);
            $user->lp = session::get('landing');
		    $user->save();

            $user_status = 'new';
		}
		try{
		    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
		    if(is_null($user->stripe_id)){
			    $stripeCustomer = $user->createAsStripeCustomer();
		    }
		    
		    // Real Price key: price_1MS6KcKGkBBmPzqnoKG8mzU9
            if($user_status == 'new'){
                \Stripe\Customer::createSource(
                    $user->stripe_id,
                    ['source' => $token]
                );
                $paymentMethod = $user->defaultPaymentMethod();

                try {
                    $user->newSubscription('Monthly Membership', env('STRIPE_PRICE_PREMIUM'))->trialDays(7)
                    ->create($paymentMethod['id'], [
                    'email' => $user->email,
                    ]);
                } catch (\Exception $e) {
                    // No such customer. Invalid value in stripe_id. Clean it, for making the next request successfully
                    $user->stripe_id = NULL;
                    $user->save();
                } 
                 // Pay with saved payment method
                \Stripe\Charge::create ([
                    "amount" => 100 * $price,
                    "currency" => "dkk",
                    "customer" => $user->stripe_id,
                    "description" => "Purchase products from Somonoda",
                    "return_url" => route('thankyou'),
                ]); 
            }else{
                 \Stripe\Charge::create ([
                    "amount" => 100 * $price,
                    "currency" => "dkk",
                    "source" => $token,
                    "description" => "Purchase products from Somonoda" ,
                    "return_url" => route('thankyou'),
                ]);
            } 
        
            // ---------- Old method -----------------
            // $user->charge($price*100, $paymentMethod['id'], ['off_session' => true]);  

            $data = [
                "username" => $user->username,
                "password" => $code, 
                "email" => $user->email,
                "user_status" => $user_status
            ];
            $user->status = 1;
            $user->save();
            Mail::to($user->email)->send(new WelcomeMail($data));
        
            foreach($cartItems as $row){
                $sale = new Sale;
                $sale->product_id = $row->id;
                $sale->price = $row->price;
                $sale->quantity = $row->quantity;
                $sale->user_id = $user->id;
                $sale->membership = $row->attributes->membership;
                $sale->firstName = session()->get('first_name');
                $sale->lastName = session()->get('last_name');
                $sale->email = session()->get('email');
                $sale->phone = session()->get('phone');
                $sale->postcode = session()->get('zipcode');
                $sale->address = session()->get('address');
                $sale->country = session()->get('country');
                $sale->town = session()->get('city');
                $sale->save();
            }
            \Cart::clear();
            \Session::forget('landing');
            return redirect()->route('thankyou');
		    // return back()->with('success','Subscription is completed.');
		}catch (Exception $e){
		  $user->delete();
		  return back()->with('success', $e->getMessage());
		}
    }

    public function process(Request $request)
    {
        // Validate the request
        $cartItems = \Cart::getContent();
        $price = \Cart::getTotal();
        $start = "277744987";
		$enddight = "988899934";
		$code = rand($start, $enddight); 
        $user = User::where('email', session()->get('email'))->first();
        $user_status = 'old';
        if($user == null){
            $user = new User();
            $user->username = session()->get('first_name').' '.session()->get('last_name');
            $user->email = session()->get('email');
            $user->phone = session()->get('phone');
            $user->type = 2;
            $user->password=Hash::make($code);
            $user->trial_ends_at = now()->addDays(7);
            $user->lp = session::get('landing');
		    $user->save();
            $user_status = 'new';
		}
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            if($user->stripe_id){
                $customer = \Stripe\Customer::retrieve($user->stripe_id);
            }else{
                $customer = \Stripe\Customer::create([
                    'name' => session()->get('first_name').' '.session()->get('last_name'),
                    'email' => session()->get('email'),
                    'payment_method' => $request->payment_method,
                ]);
                $user_status = 'new';
                $user->stripe_id = $customer->id;
                $user->save();
		    }

            try{
                // Create a payment intent with the product price
                $paymentIntent = PaymentIntent::create([
                    'amount' => 100 * $price,
                    'currency' => 'dkk',
                    'customer' => $customer->id,
                    'payment_method' => $request->payment_method,
                    'description' => 'Purchase products from Somonda',
                ]);
              
                if ($paymentIntent->status === 'requires_confirmation') {
                    // If in production mode and Stripe is in live mode, display the 3DS popup
                    if (env('APP_ENV') === 'production' && env('STRIPE_MODE') === 'live') {
                       // echo "From IF";
                        return view('frontend.3d-secure', [
                            'clientSecret' => $paymentIntent->client_secret,'user_id'=>$user->id, 
                            'code'=>$code, 'user_status' => $user_status, 'payment_method'=>$request->payment_method, 'cartItems'=> $cartItems
                        ]);
                    }
                }
               
            } catch (\Stripe\Exception\CardException $e) {
                // Handle card errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\RateLimitException $e) {
                // Handle rate limit errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                // Handle invalid request errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\AuthenticationException $e) {
                // Handle authentication errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                // Handle API connection errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle other API errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            }catch (Exception $e){
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            }
		    
        }catch (Exception $e){
            $user->delete();
            return redirect()->back()->with('error', $e->getMessage());
        }

        if($user_status == 'new'){
            try {
                $user->newSubscription('Monthly Membership', env('STRIPE_PRICE_PREMIUM'))->trialDays(7)
                ->create($request->payment_method, [
                'email' => $user->email,
                ]);
            } catch (\Exception $e) {
                // No such customer. Invalid value in stripe_id. Clean it, for making the next request successfully
                $user->stripe_id = NULL;
                $user->save();
                return redirect()->back()->with('error', $e->getMessage());
            } 
        }

        // Payment succeeded
        $data = [
            "username" => $user->username,
            "password" => $code, 
            "email" => $user->email,
            "user_status" => $user_status
        ];
        $user->status = 1;
        $user->save();
        Mail::to($user->email)->send(new WelcomeMail($data));
    
        foreach($cartItems as $row){
            $sale = new Sale;
            $sale->product_id = $row->id;
            $sale->price = $row->price;
            $sale->quantity = $row->quantity;
            $sale->user_id = $user->id;
            $sale->membership = $row->attributes->membership;
            $sale->firstName = session()->get('first_name');
            $sale->lastName = session()->get('last_name');
            $sale->email = session()->get('email');
            $sale->phone = session()->get('phone');
            $sale->postcode = session()->get('zipcode');
            $sale->address = session()->get('address');
            $sale->country = session()->get('country');
            $sale->town = session()->get('city');
            $sale->save();
        }
        \Cart::clear();
        \Session::forget('landing');
        return redirect()->route('thankyou');
    }

    public function purchase_process(Request $request)
    {
        // Validate the request
        $product = Product::find($request->id);
        $price = $product->wholesalePrice;
        $start = "277744987";
		$enddight = "988899934";
		$code = rand($start, $enddight);
        
        $user = User::where('email', session()->get('email'))->first();
        $user_status = 'old';
        if($user == null){
            $user = new User();
            $user->username = session()->get('first_name').' '.session()->get('last_name');
            $user->email = session()->get('email');
            $user->phone = session()->get('phone');
            $user->type = 2;
            $user->password=Hash::make($code);
            $user->trial_ends_at = now()->addDays(3);
            $user->lp = session::get('landing');
		    $user->save();
            $user_status = 'new';
		}
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            if($user->stripe_id){
                $customer = \Stripe\Customer::retrieve($user->stripe_id);
            }else{
                $customer = \Stripe\Customer::create([
                    'name' => session()->get('first_name').' '.session()->get('last_name'),
                    'email' => session()->get('email'),
                    'payment_method' => $request->payment_method,
                ]);
                $user_status = 'new';
                $user->stripe_id = $customer->id;
                $user->save();
		    }

            try{
                // Create a payment intent with the product price
                $paymentIntent = PaymentIntent::create([
                    'amount' => 100 * $price,
                    'currency' => 'dkk',
                    'customer' => $customer->id,
                    'payment_method' => $request->payment_method,
                    'description' => 'Purchase products from Somonda',
                    'confirm' => true
                ]);
                if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
                    return view('frontend.purchase-3d-secure', [
                        'clientSecret' => $paymentIntent->client_secret,'user_id'=>$user->id, 
                        'code'=>$code, 'user_status' => $user_status, 'payment_method'=>$request->payment_method
                    ]);
                }
        
                // Confirm the payment intent
                $paymentIntent->confirm();

            } catch (\Stripe\Exception\CardException $e) {
                // Handle card errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\RateLimitException $e) {
                // Handle rate limit errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                // Handle invalid request errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\AuthenticationException $e) {
                // Handle authentication errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                // Handle API connection errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle other API errors
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            }catch (Exception $e){
                $user->delete();
                return redirect()->back()->with('error', $e->getMessage());
            }
		    
        }catch (Exception $e){
            $user->delete();
            return redirect()->back()->with('error', $e->getMessage());
        }

        if($user_status == 'new'){
            try {
                $user->newSubscription('Monthly Membership', env('STRIPE_PRICE_PREMIUM'))->trialDays(7)
                ->create($request->payment_method, [
                'email' => $user->email,
                ]);
            } catch (\Exception $e) {
                
                // No such customer. Invalid value in stripe_id. Clean it, for making the next request successfully
                $user->stripe_id = NULL;
                $user->save();
                return redirect()->back()->with('error', $e->getMessage());
            } 
        }

        // Payment succeeded
        $data = [
            "username" => $user->username,
            "password" => $code, 
            "email" => $user->email,
            "user_status" => $user_status
        ];
        $user->status = 1;
        $user->save();
        Mail::to($user->email)->send(new WelcomeMail($data));
    
        $sale = new Sale;
        $sale->product_id = $product->id;
        $sale->price = $price;
        $sale->quantity = 1;
        $sale->user_id = $user->id;
        $sale->membership = 1;
        $sale->firstName = session()->get('first_name');
        $sale->lastName = session()->get('last_name');
        $sale->email = session()->get('email');
        $sale->phone = session()->get('phone');
        $sale->postcode = session()->get('zipcode');
        $sale->address = session()->get('address');
        $sale->country = session()->get('country');
        $sale->town = session()->get('city');
        $sale->save();
        \Session::forget('landing');
        return redirect()->route('thankyou');
    }

    public function process_success(Request $request){
        $code = $request->code;
        $user = User::find($request->user_id);
        $user_status = $request->user_status;
        $cartItems = \Cart::getContent();
        if($user_status == 'new'){
            try {
                $user->newSubscription('Monthly Membership', env('STRIPE_PRICE_PREMIUM'))->trialDays(7)
                ->create($request->payment_method, [
                'email' => $user->email,
                ]);
            } catch (\Exception $e) {
                // No such customer. Invalid value in stripe_id. Clean it, for making the next request successfully
                $user->stripe_id = NULL;
                $user->save();
                return response()->json([
                    'title' => 'Success!',
                    'status' => 'success',
                    'message' => 'Payment is success and subscription is failed'
                ]);
            } 
        }

        // Payment succeeded
        $data = [
            "username" => $user->username,
            "password" => $code, 
            "email" => $user->email,
            "user_status" => $user_status
        ];
        $user->status = 1;
        $user->save();
        Mail::to($user->email)->send(new WelcomeMail($data));
    
        foreach($cartItems as $row){
            $sale = new Sale;
            $sale->product_id = $row->id;
            $sale->price = $row->price;
            $sale->quantity = $row->quantity;
            $sale->user_id = $user->id;
            $sale->membership = $row->attributes->membership;
            $sale->firstName = session()->get('first_name');
            $sale->lastName = session()->get('last_name');
            $sale->email = session()->get('email');
            $sale->phone = session()->get('phone');
            $sale->postcode = session()->get('zipcode');
            $sale->address = session()->get('address');
            $sale->country = session()->get('country');
            $sale->town = session()->get('city');
            $sale->save();
        }
        \Cart::clear();
        \Session::forget('landing');

        return response()->json([
            'title' => 'Success!',
            'status' => 'success',
            'message' => 'Payment is success and subscription has been started!'
        ]);
    }

    public function purchase_process_success(Request $request){
        $product_id = Session::get('purchase_product');
        $product = Product::find($product_id);
        $price = $product->wholesalePrice;
        $code = $request->code;
        $user = User::find($request->user_id);
        $user_status = $request->user_status;
        if($user_status == 'new'){
            try {
                $user->newSubscription('Monthly Membership', env('STRIPE_PRICE_PREMIUM'))->trialDays(7)
                ->create($request->payment_method, [
                'email' => $user->email,
                ]);
            } catch (\Exception $e) {
                // No such customer. Invalid value in stripe_id. Clean it, for making the next request successfully
                $user->stripe_id = NULL;
                $user->save();
                return response()->json([
                    'title' => 'Success!',
                    'status' => 'success',
                    'message' => 'Payment is success and subscription is failed'
                ]);
            } 
        }

        // Payment succeeded
        $data = [
            "username" => $user->username,
            "password" => $code, 
            "email" => $user->email,
            "user_status" => $user_status
        ];
        $user->status = 1;
        $user->save();
        Mail::to($user->email)->send(new WelcomeMail($data));
    
        $sale = new Sale;
        $sale->product_id = $product->id;
        $sale->price = $price;
        $sale->quantity = 1;
        $sale->user_id = $user->id;
        $sale->membership = 1;
        $sale->firstName = session()->get('first_name');
        $sale->lastName = session()->get('last_name');
        $sale->email = session()->get('email');
        $sale->phone = session()->get('phone');
        $sale->postcode = session()->get('zipcode');
        $sale->address = session()->get('address');
        $sale->country = session()->get('country');
        $sale->town = session()->get('city');
        $sale->save();
        \Session::forget('landing');

        return response()->json([
            'title' => 'Success!',
            'status' => 'success',
            'message' => 'Payment is success and subscription has been started!'
        ]);
    }

    public function process_failed(Request $request){
        $user = User::find($request->user_id);
        $user->delete();

        return response()->json([
            'title' => 'Success!',
            'status' => 'success',
            'message' => 'Payment Failed!'
        ]);
    }
}
