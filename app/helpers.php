<?php

use Illuminate\Support\Facades\Authentication;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Country;
use App\Models\Setting;
use Carbon\Carbon;
use App\Models\Subscription;
use AmrShawky\LaravelCurrency\Facade\Currency;

function get_categories(){
    $data = Category::where('status', 1)->orderBy('name','asc')->get();
    return $data;
}

function cart_list(){
    $cartItems = \Cart::getContent();
    // dd($cartItems);
    return $cartItems;
}

function getseTotal(){
    $cartItems = \Cart::getContent();
    $total_price = 0;
    foreach($cartItems as $row){
        $total_price = $total_price + ($row->attributes->se_price * $row->quantity);
    }
    return $total_price;
}

function getnoTotal(){
    $cartItems = \Cart::getContent();
    $total_price = 0;
    foreach($cartItems as $row){
        $total_price = $total_price + ($row->attributes->no_price * $row->quantity);
    }
    return $total_price;
}

function sek_rate(){
    return Currency::convert()->from('EUR')->to('SEK')->get();
}

function nok_rate(){
    return Currency::convert()->from('EUR')->to('NOK')->get();
}

function get_subcategories($id,$level=1){
    if($level == 2){
            $data1 = Category::where('parentCategory', $id)->pluck('id');
            $categoriesWithProducts = Category::whereIn('parentCategory', $data1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereColumn('products.category_id', 'categories.id');
            })
            ->get();
            return $categoriesWithProducts;
           
    }
    else if($level == 3) {
        $data1 = Category::where('parentCategory', $id)->pluck('id');
        $data2 = Category::whereIn('parentCategory', $data1)->pluck('id');
       $categoriesWithProducts = Category::whereIn('parentCategory', $data2)
       ->whereExists(function ($query) {
           $query->select(DB::raw(1))
               ->from('products')
               ->whereColumn('products.category_id', 'categories.id');
       })
       ->get();
       return $categoriesWithProducts;

    }   
    else {
        $data = Category::where('parentCategory', $id)->get();
        return $data;
    }
   /* $data = Category::where('parentCategory', $id)->get();
    return $data;*/
}

function get_special_products(){
    $data = Product::where('status', 1)->inRandomOrder()->limit(2)->get();
    return $data;
}

function get_countries(){
    $data = Country::orderBy('name','asc')->get();
    return $data;
}

function get_featured_by_category($id){
    $data = Event::where('category_id', $id)->where('status', 1)->whereDate('to', '>', Carbon::now())->where('private', 0)->inRandomOrder()->limit(4)->get();
    return $data;
}

function is_superadmin(){
    if(auth()->user()->super_admin == 1){
        return true;
    }else{
        return false;
    }
}

function is_maintenance(){
    $setting = Setting::first();
    return $setting;
}

function product_type($id){
    return Product::find($id)->custom;
}

function check_membership($user_id){
    if(auth()->user()->type == 1){
        $subscription = Subscription::where('user_id', $user_id)->where(function($query){
            $query->where('stripe_status', 'active')->orwhere('stripe_status', 'trialing');
        })->orderBy('id','desc')->first();
                 
        if($subscription){
            $member = 1;
        }else{
            $member = 0;
        }
        return $member;
    }else{
        $member = 0;
        return $member;
    }
}
