<?php
namespace App\Http\Middleware;
use Closure;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!is_null(auth()->user())){
            if(auth()->user()->isAdmin()) {
                return $next($request);
            }
            return redirect('home');

        }else{
            return redirect('home');

        }
       
        // if (auth()->check()){

        //     if (\Admin::isAdmin()){

        //         return $next($request);

        //     }
        // }
        // return redirect('home');

    }
}