<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Mail\ContactMail;
use Carbon\Carbon;
use DB;
use Response;
use Redirect;

class HomeController extends Controller
{

    public function __construct()
    {
         $this->middleware(['auth']);
    }

    public function index()
    {
        if(auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('user.profile');
        }
    }

}
