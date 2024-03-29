<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMediator
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
        if (auth()->user()->role_id == 2 ) {

            if (auth()->user()->check_active_mediator != 1){
                toastr()->error('جاري التحقق من الحساب من قبل إدارة المنصة');
                return redirect()->back();
            }

            if (auth()->user()->check_active != 1){
                toastr()->error('يجب التفعيل من البريد الإلكتروني');
                return redirect()->back();
            }



            return $next($request);
        } else {
            toastr()->error('أنت غير مصرح لك بالدخول لهذه الصفحة');
            return redirect()->back();
        }
    }
}
