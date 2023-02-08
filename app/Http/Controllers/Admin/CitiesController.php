<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CitiesRequest;
use App\Models\City;

class CitiesController extends Controller
{
    public function index($ariaId)
    {
        $data['cities'] = City::query()->where('aria_id', $ariaId)->get();
        $data['ariaId'] = $ariaId;
        return view('admin.cities.index', $data);
    }

    public function store(CitiesRequest $request,$ariaId)
    {
        City::create([
            'ar' => [
                'title' => $request->title_ar
            ],
            'aria_id'=>$ariaId
        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($ariaId)
    {
        $data['city'] = City::query()->find($ariaId);
        return view('admin.cities.edit', $data);
    }

    public function update(CitiesRequest $request,$cityId)
    {
        City::query()->find($cityId)->update([
            'ar' => [
                'title' => $request->title_ar
            ]
        ]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


    public function destroy($cityId)
    {
        City::query()->find($cityId)->delete();
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
