<?php

namespace App\Http\Middleware;

use Auth;
use DDL\Models\User;
use Closure;

class AdminCheck
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
        if (!Auth::check()){
            return redirect()->to('/admin/auth/login');
        }

        $user = Auth::user();
        if ($user->role != User::ROLE_MANAGER){
            return redirect()->to('/admin/auth/login');
        }

        return $next($request);
    }
}
