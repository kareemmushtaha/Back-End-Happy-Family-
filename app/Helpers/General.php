<?php

use Illuminate\Support\Facades\Config;


function get_default_lang()
{
    return Config::get('app.locale');
}

function checkPermission($permissionName)
{

    $allRoles = auth()->user()->roles;
    foreach ($allRoles as $data) {
        foreach ($data->permissions as $item) {
            if ($item->title == $permissionName)
                return true;
        }
    }
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}


function getAnsweredQuestion($question_id, $user_id)
{
    $getAnsweredQuestion = \App\Models\UserQuestionAnswer::query()->where('user_id', $user_id)
        ->where('question_id', $question_id)->first();
    if ($getAnsweredQuestion) {
        return $getAnsweredQuestion->answer_question_id;
    } else {
        return "null";
    }
}


function checkUserHaveSubscription($user_id)
{
    //check
    $check_have_package = \App\Models\UserPackage::query()->where('end_date', '>', \Illuminate\Support\Carbon::now())
        ->where('user_id', $user_id)->where('status',1)
        ->first();
    if ($check_have_package)
        return true;
    return false;
}

function settingContentAr($key)
{
    $Setting = \App\Models\Setting::query()->where('key', $key)->first();
    if (!$Setting) {
        return "";
    }else{
        return $Setting->translate('ar')->value;
    }
}

function getLastChat(){


}







