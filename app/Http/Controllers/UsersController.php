<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Country;
use Illuminate\Config;
use App\Models\Subscription;
use Carbon\Carbon;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Storage;
use App\Mail\ContactMail;
use Auth;
use Redirect;
use DB;
use Stripe;                              

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $count =  User::where('type', 2)->count();
        $data = User::where('type', 2)->orderBy('id','desc')->paginate('15');
        return view('admin.users.users', compact('count','data'));
    }

    public function search(Request $request){
        // dd($request);
        $name = $request->name;
        $email = $request->email;
        
        $result = User::where('type', 2);
        if(!empty($name)){
            $result->where('username','like',"%{$name}%");
        }
        if(!empty($email)){
            $result->where('email','like',"%{$email}%");
        }
        $data = $result->orderBy('id', 'desc')->paginate('50');
        $count = $result->count();
        return view('admin.users.users', compact('count','data'));
    }

    public function add_user(){
        return view('admin.users.add_user');
    }

    public function store(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required',
         ]);

        $image = $request->file('image');
        if($image){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatar'), $image_name);
        }else{
            $image_name = '';
        }

        $User = new User;
        $User->username = $request->username;
        $User->phone = $request->phone;
        $User->email = $request->email;
        $User->type = $request->type;
        $User->image = $image_name;
        $User->password = bcrypt($request->password);
        $User->save();
        $data = [
            "username" => $request->username,
            "password" => $request->password, 
            "email" => $request->email,
            "user_status" => 'new'
        ];
        Mail::to($request->email)->send(new WelcomeMail($data));
        return Redirect::route('admin.customers')->with('success', 'New User is added successfully!');
    }

    public function edit_user($id){
        $data = User::find($id);
        return view('admin.users.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $User = User::find($id);
        if($User){
            $this->validate($request, [
                'username' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
            ]);

            $User->username = $request->username;
            $User->phone = $request->phone;
            $User->email = $request->email;

            $image = $request->file('image');
            if($image != '')
            {
                $profile_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/avatar'), $profile_image);
                if($User->image){
                    $OldImage = public_path('uploads/avatar/'.$User->image);
                    unlink($OldImage);
                }
                $User->image = $profile_image;
            }
            $User->save();
            return redirect()->back()->with('success','Profile is updated!');
            
        } else {
            return redirect()->back()->with('error','Something Went Wrong!');
        }

    }

    public function profile(){  
        // $data = User::find(auth()->user()->id);
        $data = Auth::user();
        if($data->type == 1){
            return redirect()->route('admin.profile');
        }
        elseif ($data->type == 2) {
            return view("users.profile", compact("data"));
          
        } 
    }

    // Admin Profile
    public function admin_profile(){  
        // $data = User::find(auth()->user()->id);
        $data = Auth::user();
        $countries= Country::orderBy('id','asc')->get();  
        if ($data) {
            return view("admin.profile", compact("data","countries"));
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function destroy(Request $request){
        $id = $request->id;
        $User = User::find($id);
        if($User) {
            if($User->image){
                $OldImage = public_path('uploads/avatar/'.$User->image);
                unlink($OldImage);
            }
            // $event = Event::where('user_id', $id);
            // $event->delete();
            $User->delete();
            return response()->json([
                'message' => 'User deleted successfully!'
            ]);
        } else {
            return response()->json([
                'message' => 'Something Went Wrong!'
            ]);
        }
    }

    public function change_password(Request $request){
        $id = $request->user_id;
        $User = User::find($id);
        if($User){
            if($request->password != $request->password_confirmation){
                return redirect()->back()->with('warning', 'Password does not match. Please put the same letters or numbers');
            }
            if(strlen($request->password)<5){
                return redirect()->back()->with('warning', 'Please put the same long passwords over 6 letters');
            }

            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ]);
            $User->password = bcrypt($request->password);
            $User->Save();
            return redirect()->back()->with('success', 'Password Successfully Updated');

        }
        return redirect()->back()->with('error', 'Oops, Something wrong');
    }

    public function email_preferences(){
        $data = Subscribe::where('email', auth()->user()->email)->first();
        return view('users.email_preferences', compact('data'));
    }

    public function update_email_preferences(Request $request){
        $subscribe = Subscribe::where('email', auth()->user()->email)->first();
        if($subscribe){
            if($request->unsubscribe){
                $subscribe->status = 0;
                $subscribe->save();
                return redirect()->back()->with('success', 'You have been unsubsribed successfully');
            }else{
                if($request->event_subscription){
                    $subscribe->event_subscription = $request->event_subscription;
                }else{
                    $subscribe->event_subscription = 0;
                }
                if($request->general_information){
                    $subscribe->general_information = $request->general_information;
                }else{
                    $subscribe->general_information = 0;
                }
                if($request->getting_started){
                    $subscribe->getting_started = $request->getting_started;
                }else{
                    $subscribe->getting_started = 0;
                }
                if($request->marketing_information){
                    $subscribe->marketing_information = $request->marketing_information;
                }else{
                    $subscribe->marketing_information = 0;
                }
                if($request->monthly_newsletter){
                    $subscribe->monthly_newsletter = $request->monthly_newsletter;
                }else{
                    $subscribe->monthly_newsletter = 0;
                }
                if($request->subscriber_information){
                    $subscribe->subscriber_information = $request->subscriber_information;
                }else{
                    $subscribe->subscriber_information = 0;
                }
                if($request->customer_service_communication){
                    $subscribe->customer_service_communication = $request->customer_service_communication;
                }else{
                    $subscribe->customer_service_communication = 0;
                }
                if($request->one_to_one){
                    $subscribe->one_to_one = $request->one_to_one;
                }else{
                    $subscribe->one_to_one = 0;
                }
                $subscribe->save();
                return redirect()->back()->with('success', 'You have been updated email preferences');
            }
        }else{
            $subscribe = new Subscribe;
            $subscribe->email = auth()->user()->email;
            if($request->event_subscription){
                $subscribe->event_subscription = $request->event_subscription;
            }else{
                $subscribe->event_subscription = 0;
            }
            if($request->general_information){
                $subscribe->general_information = $request->general_information;
            }else{
                $subscribe->general_information = 0;
            }
            if($request->getting_started){
                $subscribe->getting_started = $request->getting_started;
            }else{
                $subscribe->getting_started = 0;
            }
            if($request->marketing_information){
                $subscribe->marketing_information = $request->marketing_information;
            }else{
                $subscribe->marketing_information = 0;
            }
            if($request->monthly_newsletter){
                $subscribe->monthly_newsletter = $request->monthly_newsletter;
            }else{
                $subscribe->monthly_newsletter = 0;
            }
            if($request->subscriber_information){
                $subscribe->subscriber_information = $request->subscriber_information;
            }else{
                $subscribe->subscriber_information = 0;
            }
            if($request->customer_service_communication){
                $subscribe->customer_service_communication = $request->customer_service_communication;
            }else{
                $subscribe->customer_service_communication = 0;
            }
            if($request->one_to_one){
                $subscribe->one_to_one = $request->one_to_one;
            }else{
                $subscribe->one_to_one = 0;
            }
            $subscribe->save();
            return redirect()->back()->with('success', 'You have been updated email preferences');
        }
        
    }
}