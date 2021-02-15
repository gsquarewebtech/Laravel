<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserPermission;
use App\Models\UserRole;
use Auth;
use Illuminate\Support\Facades\Route;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $roleid  = Auth::user()->user_type;

        if($roleid != 1)
        {
            $prms = UserPermission::where('role_id', $roleid)->first();      
            $permissions = $prms['role_permissions'];
            if($permissions){
                $route = Route::getCurrentRoute();
                $allowedroute = in_array($route->action['as'],array_keys($permissions));
                if($allowedroute !==false){
                    return $next($request);
                }
                
                return redirect()->route('dashboard');
            }
        }
        

        return $next($request);
        
    }
}
