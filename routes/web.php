<?php

use App\Http\Controllers\Site\ChatController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SearchController;
use App\Http\Controllers\Site\UserController;

//Route::redirect('/', '/login');
//Route::get('/home', function () {
//    if (session('status')) {
//        return redirect()->route('admin.home')->with('status', session('status'));
//    }
//    return redirect()->route('admin.home');
//});
Route::get('abouts', function () {
    return view('site.about-us');
});
Route::get('policy', function () {
    return view('site.privacy-policy');
});
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
//Auth::routes();

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('user.register');
Route::get('register', [\App\Http\Controllers\AuthController::class, 'register_page'])->name('site_register');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('login', [\App\Http\Controllers\AuthController::class, 'login_page'])->name('site_login');
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('landing', [HomeController::class, 'landing'])->name('landing');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::post('/homeSearch', [HomeController::class, 'homeSearch'])->name('homeSearch');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::post('sendContactUs', [HomeController::class, 'sendContactUs'])->name('sendContactUs');
Route::post('sendContactUsLanding', [HomeController::class, 'sendContactUsLanding'])->name('sendContactUsLanding');

Route::post('filterAreas', [SearchController::class, 'filterAreas'])->name('filterAreas');
Route::post('filterCities', [SearchController::class, 'filterCities'])->name('filterCities');
Route::get('questions-answer', [HomeController::class, 'questions_answer'])->name('question_answer');
Route::get('package/{package_id}', [HomeController::class, 'package_details'])->name('package');
Route::get('my-profile', [UserController::class, 'my_profile'])->name('my_profile');
Route::get('personally/{user_id}', [UserController::class, 'personally'])->name('personally');
Route::post('update/answer-questions', [UserController::class, 'update_answer_questions'])->name('update-answer-questions');


Route::group(['middleware' => ['auth', 'checkActivateAccount']], function () {
    Route::get('edit-profile', [UserController::class, 'edit_profile'])->name('edit_profile');
    Route::post('update-profile', [UserController::class, 'update_profile'])->name('update_profile');
});


Route::group(['middleware' => ['CheckCompleteProfile', 'checkActivateAccount']], function () {
    Route::get('advanced-search', [SearchController::class, 'advanced_search'])->middleware(['auth'])->name('advanced-search');
    Route::post('result-advanced-search', [SearchController::class, 'resultAdvancedSearch'])->name('result-advanced-search');
    Route::get('paginate-result-advanced-search', [SearchController::class, 'paginateUser'])->name('paginateUser');
});


Route::group(['prefix' => 'chat', 'as' => 'chat.', 'middleware' => ['auth', '2fa', 'checkActivateAccount']], function () {
    Route::get('/', [ChatController::class, 'index'])->name('index');
    Route::get('create/{user_id}', [ChatController::class, 'createAndOpenChat'])->name('createAndOpenChat');
    Route::get('getMessages', [ChatController::class, 'getMessages'])->name('getMessages');
    Route::post('searchMessages', [ChatController::class, 'searchMessages'])->name('searchMessages');
    Route::get('getChat', [ChatController::class, 'getChat'])->name('getChat');
    Route::get('chat/{chat_id?}', [ChatController::class, 'getMessagesChatMessage'])->name('getChatMessage');
    Route::get('send/question/chat', [ChatController::class, 'send_question_chat'])->name('send_question_chat');
    Route::get('send/answer/chat', [ChatController::class, 'send_answer_chat'])->name('send_answer_chat');
    Route::get('send/custom/answer/chat', [ChatController::class, 'send_custom_answer_chat'])->name('send_custom_answer_chat');
    Route::get('send/custom/question/chat', [ChatController::class, 'send_custom_question_chat'])->name('send_custom_question_chat');
});




Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa', 'checkActivateAccount']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});

Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});

Route::view('about-us', 'site.about-us');
Route::view('search', 'site.search');
Route::view('result-search', 'site.result-search');
Route::view('notifications', 'site.notifications');
//Route::view('personally', 'site.personally');


Route::get('urway/checkout/{packageId}', 'UrwayPaymentController@getTransaction')->name('urway.payment.checkout');
Route::get('urway/response/{userPackageId}', 'UrwayPaymentController@getResponse')->name('urway.payment.response');
Route::get('urway/success', 'UrwayPaymentController@urwaySuccess')->name('urway.success.transaction');
Route::get('urway/fail', 'UrwayPaymentController@urwayFail')->name('urway.fail.transaction');

Route::get('subscription/{package_id}', [HomeController::class, 'subscription'])->name('subscription');


include 'admin.php';








