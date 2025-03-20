<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class IsMaintenance extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $except = [
        // URIs, https://laravel.com/docs/master/routing#csrf-excluding-uris
        'admin/*','/login'
    ];

    public function handle($request, Closure $next)
    {
        if(is_maintenance()->maintenance == 1){
            return redirect('maintenance');
        }else{
            // return redirect('home');
            return $next($request);

        }
    }
}