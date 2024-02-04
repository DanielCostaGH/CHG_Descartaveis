<?php

namespace App\Http\Middleware;

use App\Models\PersonalAccessTokens;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
        {
            if (Auth::guard('admin')->check()) {
                $token = PersonalAccessTokens::where('admin_id', Auth::guard('admin')->id())
                                          ->first();

            if ($token && $token->expires_at > now()) {
                return $next($request);
            }
        }
    
            return redirect()->route('admin.login');
        }
}
