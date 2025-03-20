<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Sale;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Arr;
use Illuminate\Mail\Message;
use DateTime;
use DateInterval;
use DatePeriod;
use Auth;
use Datatables;
use Redirect;
use DB;
use Stripe;
use Carbon\Carbon;
 

class AdminController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
        $this->middleware(['auth']);
    }

    // ================================= Admin Dashboard ==========================================
    public function dashboard(){

        $customers = User::where('type', 2)->count();
        $categories = Category::count();
        $products = Product::count();
        $active_products = Product::where('status','1')->count();
        $sales = Sale::sum(\DB::raw('price * quantity'));
        $sales_count = Sale::count();

        return view('admin.dashboard',compact('products','categories','customers', 'sales', 'active_products', 'sales_count'));
    }

    // ============================== Statistics =====================================================
   

    public function statistics_view(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $month = array();
        $sales = array();
        $start = (new DateTime($start_date))->modify('first day of this month');
        $end = (new DateTime($end_date))->modify('first day of next month');

        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            // echo $dt->format("m") . "<br>\n";
            $month[] = $dt->format("F");
            $sales[] = Sale::whereMonth('created_at',$dt->format("m"))->sum(\DB::raw('price * quantity'));
            // $customers[] = User::where('type', 2)->whereMonth('created_at',$dt->format("m"))->count();
        }
        $data['sales'] = $sales;
        $data['month'] = $month;
        echo json_encode($data);
        exit;
    }

    public function update_maintenance(Request $request){
        $setting = Setting::first();
        $setting->maintenance = $request->status;
        $setting->period = $request->period;
        $setting->save();
        
        if($request->status == 1){
            return Redirect::back()->with('warning', 'Site is under maintenance!');  
        }else{
            return Redirect::back()->with('success', 'Site is live mode now');  
        }
    }
 
}
