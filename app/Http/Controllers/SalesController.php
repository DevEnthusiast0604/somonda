<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Sale;
use App\Models\Order;
use Illuminate\Config;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Auth;
use Redirect;
use DB;
use Stripe;              
use Illuminate\Support\Facades\Http;


class SalesController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $count =  Sale::count();
        $data = Sale::orderBy('id', 'desc')->paginate('15');
        return view('admin.sales', compact('count','data'));
    }

    public function search(Request $request){
        // dd($request);
        $product_id = $request->product_id;
        $email = $request->email;
        $country = $request->country;
        $date = $request->date;
        
        $result = Sale::where('membership', 1);
        if(!empty($product_id)){
            $result->where('product_id', $product_id);
        }
        if(!empty($email)){
            $result->where('email','like',"%{$email}%");
        }
        if(!empty($country)){
            $result->where('country', $country);
        }
        if(!empty($date)){
            $result->whereDate('created_at', $date);
        }
        $data = $result->orderBy('id', 'desc')->paginate('50');
        $count = $result->count();
        return view('admin.sales', compact('count','data'));
    }

    public function user_products(){
        $count = Sale::where('user_id', auth()->user()->id)->count();
        $data = Sale::where('user_id', auth()->user()->id)->orderBy('id' ,'desc')->get();
        return view('users.products', compact('count','data'));
    }

    public function destroy(Request $request){
        $id = $request->id;
        $sale = Sale::find($id);
        if($sale) {
            $sale->delete();
            return response()->json([
                'message' => 'Sales history deleted successfully!'
            ]);
        } else {
            return response()->json([
                'message' => 'Something Went Wrong!'
            ]);
        }
    }

    public function order(Request $request, $id){
        $token = env('BIGBUY_API_KEY');
        $url = env('BIGBUY_API_URL');

        $sale = Sale::find($id);
        if($sale->country == 'SE'){
            $lang = 'sv';
        }elseif($sale->country == 'FR'){
            $lang = 'fr';
        }elseif($sale->country == 'PT'){
            $lang = 'pt';
        }elseif($sale->country == 'DK'){
            $lang = 'da';
        }elseif($sale->country == 'IT'){
            $lang = 'it';
        }elseif($sale->country == 'NL'){
            $lang = 'nl';
        }elseif($sale->country == 'FI'){
            $lang = 'fi';
        }elseif($sale->country == 'GE'){
            $lang = 'ge';
        }elseif($sale->country == 'NO'){
            $lang = 'no';
        }else{
            $lang = 'en';
        }

        $sale->firstName = $request->firstName;
        $sale->lastName = $request->lastName;
        $sale->address = $request->address;
        $sale->town = $request->town;
        $sale->phone = $request->phone;
        $sale->email = $request->email;
        $sale->country = $request->country;
        $sale->postcode = $request->postcode;
        $sale->save();

        $bigbuy['order'] = array(
            'internalReference' => $sale->id,
            'cashOnDelivery' => 0,
            'language' => $lang,
            'paymentMethod' => 'moneybox',
            'carriers' => array (
                0 => array(
                'name' => 'gls',
                ) 
            ),
        );
    
        $bigbuy['order']['shippingAddress'] = array(
                'firstName' => $sale->firstName,
                'lastName' => $sale->lastName,
                'country' => $sale->country,
                'postcode' => $sale->postcode,
                'town' => $sale->town,
                'address' => $sale->address,
                'phone' => $sale->phone,
                'email' => $sale->email,
                'comment' => '',
            );
    
        $bigbuy['order']['products'] = array(
            0 => array(
                'reference' => $sale->product->sku,
                'quantity' => $sale->quantity,
            ) 
        );
    
 
        $ch = curl_init($url."order/create.json");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($bigbuy));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));
    
        $result = curl_exec($ch);
        $response = json_decode($result, true);

        if (array_key_exists("order_id", $response)){
            $order = new Order;
            $order->id = $response['order_id'];
            $order->sale_id = $sale->id;
            $order->status = 1;
            $order->save();
            return redirect()->back()->with('success', 'Successfully ordered');
        }else{
            $message = json_decode($response["message"], true);
             return redirect()->back()->with('error', $response["message"]);
        } 

    }
}