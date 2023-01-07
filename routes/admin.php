<?php

use App\Http\Controllers\Admin\AnswerChatController;
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
    Route::resource('users', 'UsersController');

    Route::resource('questions-chat', 'QuestionChatController');
    Route::resource('personal-questions', 'PersonalQuestionsController');
    Route::resource('personal-answer-questions', 'PersonalAnswerQuestionsController');
    Route::resource('answers-chat', 'AnswerChatController');
    Route::get('request/question/chat', [QuestionChatController::class, 'customQuestionChat'])->name('questions-chat.customQuestionChat');
    Route::get('request/answer/chat', [AnswerChatController::class, 'customAnswerChat'])->name('answers-chat.customAnswerChat');
    Route::get('change/status/request/question/chat', [QuestionChatController::class, 'changeStatusRequestQuestionChat'])->name('questions-chat.changeStatusRequestQuestionChat');
    Route::get('change/status/request/answer/chat', [AnswerChatController::class, 'changeStatusRequestAnswerChat'])->name('answers-chat.changeStatusRequestAnswerChat');

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












