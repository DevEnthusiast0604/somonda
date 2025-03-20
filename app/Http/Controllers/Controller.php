<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use MetaTag;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        //defaults
        MetaTag::set('description', 'Festum is your news, entertainment, music & fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.');
        MetaTag::set('image', asset('assets/images/logo.png'));
    }
}
