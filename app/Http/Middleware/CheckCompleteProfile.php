<?php

namespace App\Http\Middleware;

use App\Models\Question;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CheckCompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $count_user_answered = auth()->user()->user_question_answers->count();
        $count_required_question = Question::query()->Active()->count();

        if ($count_user_answered < $count_required_question) {
            toastr()->error(trans('global.please_complete_profile'), ['timeOut' => 10000, 'closeButton' => true]);


            return redirect()->route('my_profile');
        } else {
            return $next($request);
        }


    }
}
