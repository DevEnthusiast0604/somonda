<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Category;
use App\Models\Productdetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Mail\ContactMail;
use App\Mail\WelcomeMail;
use Carbon\Carbon;
use DB;
use Response;
use Redirect;
use MetaTag;
use Stevebauman\Location\Facades\Location;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Support\Facades\Hash;
use Session;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Storage;
use Stripe\PaymentIntent;


class FrontendController extends Controller
{
    // public function track_vistors(){
        
    //     $ip_address = Request()->ip();
    //     $exist_visitor = Visitor::where('ip_address', $ip_address)->where( 'created_at', '>', Carbon::now()->subDays(1))->first();
        
    //     if(!$exist_visitor){
    //         $visitor = new Visitor;
    //         $visitor->ip_address = $ip_address;
    //         $visitor->save();
    //     } 
    // }

    private $bigbuy_api_url;
    private $bigbuy_api_key;

    public function __construct(){
        $this->bigbuy_api_url = env('BIGBUY_API_URL');
        $this->bigbuy_api_key = env('BIGBUY_API_KEY');
    }

    public function index(Request $request){
        App::setLocale('fr');
        session()->put('locale', 'en');
        $bestseller1 = Product::where('status', 1)->orderBy('name')->take('4')->get();
        $bestseller2 = Product::where('status', 1)->orderBy('name','desc')->take('6')->get();
        $new_products = Product::where('status', 1)->where('condition', 'NEW')->inRandomOrder()->take('15')->get();
        $new_products_count = Product::where('status', 1)->where('condition', 'NEW')->count();
        return view('frontend.index', compact('bestseller1', 'bestseller2', 'new_products','new_products_count'));
     }

    public function products_all(){
        $products = Product::where('status', 1)->orderBy('name','desc')->paginate('20');
        $count = Product::where('status', 1)->count();
        return view('frontend.products.all_products', compact('count', 'products'));
    }
    public function products($url){
        $category = Category::where('url', $url)->first();
        $subcategories = Category::where('parentCategory', $category->id)->get();
        $categories = Category::where('parentCategory', $category->parentCategory)->get();
        $products = Product::where('category_id', $category->id)->paginate('20');
        return view('frontend.products.list', compact('category', 'products','subcategories','categories'));
    }

    public function product_details($url){
        $data = Product::where('url', $url)->first();
        $new_products = Product::where('status', 1)->where('condition', 'NEW')->inRandomOrder()->limit(4)->get();
        $new_products_count = Product::where('status', 1)->where('condition', 'NEW')->count();
        $sek_rate = Currency::convert()->from('EUR')->to('SEK')->get();
        $nok_rate = Currency::convert()->from('EUR')->to('NOK')->get();
        $price = \Cart::getTotal();
        if($price != 0){
            $success = 1;
            return view('frontend.products.details', compact('data', 'new_products','new_products_count','sek_rate','nok_rate','success'));
        }else{
            return view('frontend.products.details', compact('data', 'new_products','new_products_count','sek_rate','nok_rate'));
        }
    }

    public function product_view(Request $request, $url){
        $data = Product::where('url', $url)->first();
        if($data) {
        if($request->lang == "fr"){
            app()->setLocale("fr");
            $lang = "fr";
            $product = [
               "name" => $data->detail->fr_name,
               "description" => $data->detail->fr_description
            ];
            // return view('frontend.products.fr_view', compact('data','product'));
        }elseif($request->lang == "it"){
            app()->setLocale("it");
            $lang = "it";
            $product = [
               "name" => $data->detail->it_name,
               "description" => $data->detail->it_description
            ];
            // return view('frontend.products.it_view', compact('data','product'));
        }elseif($request->lang == "sv"){
            app()->setLocale("sv");
            $lang = "sv";
            $product = [
                "name" => $data->detail->sv_name,
                "description" => $data->detail->sv_description
            ];
        }elseif($request->lang == "pt"){
            app()->setLocale("pt");
            $lang = "pt";
            $product = [
                "name" => $data->detail->pt_name,
                "description" => $data->detail->pt_description
            ];
        }elseif($request->lang == "da"){
            app()->setLocale("da");
            $lang = "da";
            $product = [
                "name" => $data->detail->da_name,
                "description" => $data->detail->da_description
            ];
        }elseif($request->lang == "nl"){
            app()->setLocale("nl");
            $lang = "nl";
            $product = [
                "name" => $data->detail->nl_name,
                "description" => $data->detail->nl_description
            ];
        }elseif($request->lang == "ge"){
            app()->setLocale("ge");
            $lang = "ge";
            $product = [
                "name" => $data->detail->ge_name,
                "description" => $data->detail->ge_description
            ];
        }elseif($request->lang == "fi"){
            app()->setLocale("fi");
            $lang = "fi";
            $product = [
                "name" => $data->detail->fi_name,
                "description" => $data->detail->fi_description
            ];
        }elseif($request->lang == "no"){
            app()->setLocale("no");
            $lang = "no";
            $product = [
                "name" => $data->detail->no_name,
                "description" => $data->detail->no_description
            ];
        }else{
            app()->setLocale("en");
            $lang = "en";
            $product = [
                "name" => $data->name,
                "description" => $data->description
            ];
        }
    }
        $sek_rate = Currency::convert()->from('EUR')->to('SEK')->get();
        $nok_rate = Currency::convert()->from('EUR')->to('NOK')->get();
        if($data){
            \Session::put('locale',$lang);
            \Session::put('landing', 1);

            $price = \Cart::getTotal();
            if($price != 0){
                $success = 1;
                return view('frontend.products.view', compact('data','sek_rate','nok_rate','product','success'));
            }else{
                return view('frontend.products.view', compact('data','sek_rate','nok_rate','product'));
            }

        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function product_purchase(Request $request, $url){
        $data = Product::where('url', $url)->first();
        if($request->lang == "fr"){
            app()->setLocale("fr");
            $lang = "fr";
            $product = [
               "name" => $data->detail->fr_name,
               "description" => $data->detail->fr_description
            ];
            
        }elseif($request->lang == "it"){
            app()->setLocale("it");
            $lang = "it";
            $product = [
               "name" => $data->detail->it_name,
               "description" => $data->detail->it_description
            ];
        }elseif($request->lang == "sv"){
            app()->setLocale("sv");
            $lang = "sv";
            $product = [
                "name" => $data->detail->sv_name,
                "description" => $data->detail->sv_description
            ];
        }elseif($request->lang == "pt"){
            app()->setLocale("pt");
            $lang = "pt";
            $product = [
                "name" => $data->detail->pt_name,
                "description" => $data->detail->pt_description
            ];
        }elseif($request->lang == "da"){
            app()->setLocale("da");
            $lang = "da";
            $product = [
                "name" => $data->detail->da_name,
                "description" => $data->detail->da_description
            ];
        }elseif($request->lang == "nl"){
            app()->setLocale("nl");
            $lang = "nl";
            $product = [
                "name" => $data->detail->nl_name,
                "description" => $data->detail->nl_description
            ];
        }elseif($request->lang == "ge"){
            app()->setLocale("ge");
            $lang = "ge";
            $product = [
                "name" => $data->detail->ge_name,
                "description" => $data->detail->ge_description
            ];
        }elseif($request->lang == "fi"){
            app()->setLocale("fi");
            $lang = "fi";
            $product = [
                "name" => $data->detail->fi_name,
                "description" => $data->detail->fi_description
            ];
        }elseif($request->lang == "no"){
            app()->setLocale("no");
            $lang = "no";
            $product = [
                "name" => $data->detail->no_name,
                "description" => $data->detail->no_description
            ];
        }else{
            app()->setLocale("en");
            $lang = "en";
            $product = [
                "name" => $data->name,
                "description" => $data->description
            ];
        }
     
        if($data){
            \Session::put('locale',$lang);
            return view('frontend.products.purchase_view', compact('data','product'));
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    } 

    // =========================== Countries Ajax Call =======================================
    public function getcountries(){
        $countries= Country::where('status', '1')->orderBy('name','ASC')->pluck("phonecode","name");
        return response()->json($countries);
    }

    public function getStates($name)
    {
        $country = Country::where('name',$name)->first();
        // $states = State::where('country_id',$country->id)->orderBy('name', 'ASC')->pluck('name','id');
        $states = State::where('country_id',$country->id)->orderBy('name', 'ASC')->get(['name','id']);
        return response()->json($states);
    }

    // For fetching cities
    public function getCities($id)
    {
        $cities= DB::table("cities")->where("state_id",$id)->orderBy('name', 'ASC')->get(['name','id']);
        return response()->json($cities);
    }

    // =========================== Categories Ajax Call =======================================
      public function get_categories(){
        $categories= Category::where('status', 1)->orderBy('name','ASC')->pluck("name","id");
        return response()->json($categories);
    }

    public function get_subcategories($id)
    {
        $subcategories = Subcategory::where('category_id',$id)->where('status', 1)->orderBy('name', 'ASC')->get(['name','id']);
        return response()->json($subcategories);
    }
  
    // ============================= Search ===============================
    public function search(Request $request){
        // dd($request);
        $keyword = $request->keyword;
        
        $result = Prpduct::where('status','1');

        if(!empty($keyword)){
            $result->where('title','like',"%{$keyword}%");
        }

        $data = $result->orderBy('id', 'desc')->paginate(12);
        $count = $result->count();
        return view('frontend.products.search', compact('data','count'));
    }
    
    // =================================================================================
    public function contact(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            // 'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);
        Mail::to('support@plusdeal.fr')->send(new ContactMail($request));
        // Mail::to('dev.expertweblancer@gmail.com')->send(new ContactMail($request));
        return Redirect::back()->with('success', 'We will touch you soon in 24 hours.');
    }

    public function membership(Request $request){
        if($request->lang == "fr"){
            app()->setLocale("fr");
        }elseif($request->lang == 'pt'){
            app()->setLocale('pt');
        }elseif($request->lang == 'it'){
            app()->setLocale('it');
        }
        return view('frontend.membership_checkout');
    }

    public function membership_checkout(Request $request){
        // Validate the request
        $name = $request->name;
        $email = $request->email;
        $start = "277744987";
		$enddight = "988899934";
		$code = rand($start, $enddight);
        
        $user = User::where('email', $email)->first();
        if($user){
            if(check_membership($user->id) == 1){
                return redirect()->back()->with('error', 'You are already subscribed member!');
            }else{
                $user->username = $name;
                $user->email = $email;
                $user->password=Hash::make($code);
                $user->trial_ends_at = now()->addDays(3);
                $user->save();
                $user_status = 'new';
            }
        }else{
            $user = new User();
            $user->username = $name;
            $user->email = $email;
            $user->type = 2;
            $user->password=Hash::make($code);
            $user->trial_ends_at = now()->addDays(3);
		    $user->save();
            $user_status = 'new';
        }
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            if($user->stripe_id){
                $customer = \Stripe\Customer::retrieve($user->stripe_id);
            }else{
                $customer = \Stripe\Customer::create([
                    'name' => $name,
                    'email' => $email,
                    'payment_method' => $request->payment_method,
                ]);
                $user_status = 'new';
                $user->stripe_id = $customer->id;
                $user->save();
		    }

            try{
                // Create a payment intent with the product price
                $paymentIntent = PaymentIntent::create([
                    'amount' => 100 * 2.95,
                    'currency' => 'eur',
                    'customer' => $customer->id,
                    'payment_method' => $request->payment_method,
                    'description' => 'Purchase products from PlusDeal',
                    'confirm' => true
                ]);
                if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
                    return view('frontend.membership-3d-secure', [
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
    }

    public function membership_process_success(Request $request){
        $code = $request->code;
        $user = User::find($request->user_id);
        $user_status = $request->user_status;
        if($user_status == 'new'){
            try {
                $user->newSubscription('Monthly Membership', env('STRIPE_PRICE_PREMIUM'))->trialDays(3)
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

        return response()->json([
            'title' => 'Success!',
            'status' => 'success',
            'message' => 'Payment is success and subscription has been started!'
        ]);
    }

    public function member_register_checkout(Request $request){
        $cartItems = \Cart::getContent();
        $price = \Cart::getTotal();

        $start = "277744987";
		$enddight = "988899934";
		$code = rand($start, $enddight);
		$token =  $request->stripeToken;
		
		$user = User::where('email', session()->get('email'))->first();
        if($user){
            return redirect()->back()->with('error', 'Email is already exist!');
        }
 
        $user = new User();
        $user->username = $request->name;
        $user->email =  $request->email;
        $user->type = 2;
        $user->password=Hash::make($code);
        $user->trial_ends_at = now()->addDays(7);
        $user->save();
		 
		try{
		    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
		    if(is_null($user->stripe_id)){
			    $stripeCustomer = $user->createAsStripeCustomer();
		    }
		    
		    // Real Price key: price_1MS6KcKGkBBmPzqnoKG8mzU9
        
            \Stripe\Customer::createSource(
                $user->stripe_id,
                ['source' => $token]
            );
            $paymentMethod = $user->defaultPaymentMethod();

            try {
                $user->newSubscription('Monthly Membership', env('STRIPE_PRICE'))->trialDays(7)
                ->create($paymentMethod['id'], [
                'email' => $user->email,
                ]);
            } catch (\Exception $e) {
                $user->delete();
                return redirect()->back()->with('error', 'Something went wrong with Credit card');
            } 
        
            $data = [
                "username" => $user->username,
                "password" => $code, 
                "email" => $user->email,
                "user_status" => 'new'
            ];
            $user->status = 1;
            $user->save();
            Mail::to($user->email)->send(new WelcomeMail($data));
            
            return redirect()->route('login')->with('success', ' You are now member of PlusDeal. We sent an email with your password.');
		}catch (Exception $e){
		  $user->delete();
		  return back()->with('error', $e->getMessage());
		}
    }
}

