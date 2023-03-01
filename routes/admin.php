<?php

use App\Http\Controllers\Admin\AnswerChatController;
use App\Http\Controllers\Admin\AriasController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\QuestionChatController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Mediator\FollowMediatorChatController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');
    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::get('users/change-password', [UsersController::class, 'changePassword'])->name('users.changePassword');
    Route::post('users/change-password', [UsersController::class, 'saveChangePassword'])->name('users.saveChangePassword');
    Route::post('users/change-status', [UsersController::class, 'changeStatus'])->name('users.changeStatus');
    Route::post('users/upgrade-subscription/{userId}', [UsersController::class, 'upgradeSubscription'])->name('users.upgradeSubscription');
    Route::resource('users', 'UsersController');
    Route::resource('countries', 'CountriesController');

    Route::group(['prefix' => 'arias', 'as' => 'arias.'], function () {

        Route::get('country/{countryId}', [AriasController::class, 'index'])->name('index');
        Route::get('{ariaId}/edit', [AriasController::class, 'edit'])->name('edit');
        Route::PUT('{ariaId}/update', [AriasController::class, 'update'])->name('update');
        Route::post('store/{countryId}', [AriasController::class, 'store'])->name('store');
        Route::delete('{ariaId}/delete', [AriasController::class, 'destroy'])->name('destroy');

    });

    Route::group(['prefix' => 'cities', 'as' => 'cities.'], function () {

        Route::get('arias/{ariaId}', [CitiesController::class, 'index'])->name('index');
        Route::get('{cityId}/edit', [CitiesController::class, 'edit'])->name('edit');
        Route::PUT('{cityId}/update', [CitiesController::class, 'update'])->name('update');
        Route::post('store/{ariaId}', [CitiesController::class, 'store'])->name('store');
        Route::delete('{cityId}/delete', [CitiesController::class, 'destroy'])->name('destroy');

    });

    Route::resource('questions-chat', 'QuestionChatController');
    Route::resource('personal-questions', 'PersonalQuestionsController');
    Route::resource('personal-answer-questions', 'PersonalAnswerQuestionsController');
    Route::resource('answers-chat', 'AnswerChatController');
    Route::get('request/question/chat', [QuestionChatController::class, 'customQuestionChat'])->name('questions-chat.customQuestionChat');
    Route::get('request/answer/chat', [AnswerChatController::class, 'customAnswerChat'])->name('answers-chat.customAnswerChat');
    Route::get('accept/request/question/chat', [QuestionChatController::class, 'acceptRequestQuestionChat'])->name('questions-chat.acceptRequestQuestionChat');
    Route::get('reject/request/question/chat', [QuestionChatController::class, 'rejectRequestQuestionChat'])->name('questions-chat.rejectRequestQuestionChat');

    Route::get('accept/request/answer/chat', [AnswerChatController::class, 'acceptRequestAnswerChat'])->name('answer-chat.acceptRequestAnswerChat');
    Route::get('reject/request/answer/chat', [AnswerChatController::class, 'rejectRequestAnswerChat'])->name('answer-chat.rejectRequestAnswerChat');

    //Setting
    Route::resource('settings', 'SettingController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    Route::post('settings/save-setting', 'SettingController@saveSetting')->name('settings.saveSetting');

    //Package
    Route::resource('packages', 'PackageController', ['except' => ['create', 'store', 'destroy']]);

    //ContactUs
    Route::resource('contact-us', 'ContactUsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    //Subscriptions
    Route::resource('subscriptions', 'SubscriptionController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    //Success Story
    Route::resource('success-stories', 'SuccessStoryController');
    Route::resource('view-personal-info', 'ViewPersonalInformationController');

    //Fqa
    Route::resource('fqas', 'FqaController');


    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
});


Route::group(['prefix' => 'mediator', 'as' => 'mediator.', 'namespace' => 'Mediator', 'middleware' => ['auth', '2fa']], function () {

    Route::group(['middleware' => ['checkMediator']], function () {
        Route::resource('users', 'UsersMediatorController');
        Route::post('filterAreas', [\App\Http\Controllers\Mediator\UsersMediatorController::class, 'filterAreas'])->name('filterAreas');
        Route::post('filterCities', [\App\Http\Controllers\Mediator\UsersMediatorController::class, 'filterCities'])->name('filterCities');
        Route::group(['prefix' => 'follow-mediator-chat', 'as' => 'chat.', 'middleware' => ['auth', '2fa', 'checkActivateAccount']], function () {
            Route::get('/{user_follow_mediator}', [FollowMediatorChatController::class, 'index'])->name('index');
            Route::get('create/{user_follow_mediator}/{user_id}', [FollowMediatorChatController::class, 'createAndOpenChat'])->name('createAndOpenChat');
            Route::get('getMessages/{user_follow_mediator}', [FollowMediatorChatController::class, 'getMessages'])->name('getMessages');
            Route::post('searchMessages', [FollowMediatorChatController::class, 'searchMessages'])->name('searchMessages');
            Route::get('getChat/{user_follow_mediator}', [FollowMediatorChatController::class, 'getChat'])->name('getChat');
            Route::get('chat/{user_follow_mediator}/{chat_id?}', [FollowMediatorChatController::class, 'getMessagesChatMessage'])->name('getChatMessage');
            Route::get('send/question/chat/{user_follow_mediator}', [FollowMediatorChatController::class, 'send_question_chat'])->name('send_question_chat');
            Route::get('send/answer/chat/{user_follow_mediator}', [FollowMediatorChatController::class, 'send_answer_chat'])->name('send_answer_chat');
            Route::get('send/custom/answer/chat/{user_follow_mediator}', [FollowMediatorChatController::class, 'send_custom_answer_chat'])->name('send_custom_answer_chat');
            Route::get('send/custom/question/chat/{user_follow_mediator}', [FollowMediatorChatController::class, 'send_custom_question_chat'])->name('send_custom_question_chat');
        });
    });

});












