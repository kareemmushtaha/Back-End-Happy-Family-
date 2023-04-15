<?php

namespace App\Providers;

use App\Models\Conversations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     *
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                $authId = \auth()->user()->id;
                $questionsChatNotAnswered=Conversations::query()->where('received_id', $authId)->whereNull('answer_chat_id')->get();
                $view->with('questionsChatNotAnswered', $questionsChatNotAnswered);
            }else {
                $view->with('questionsChatNotAnswered', null);
            }

        });
    }


}
