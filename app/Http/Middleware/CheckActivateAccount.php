<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActivateAccount
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
        if (auth()->user()->check_active == 1 ||auth()->user()->verified == 0)
        {
            if (auth()->user()->role_id == 2 && auth()->user()->check_active_mediator != 1 ) {
                toastr()->error('الحساب مقيد من قبل إدارة الموقع');
                return redirect()->back();
            }

            return $next($request);
        } else {
            toastr()->error('أنت غير مصرح لك بالدخول لهذه الصفحة');
            return redirect()->back();
        }
    }
}
