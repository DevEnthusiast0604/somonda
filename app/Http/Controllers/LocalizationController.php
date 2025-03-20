<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
    public function index($locale){
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
