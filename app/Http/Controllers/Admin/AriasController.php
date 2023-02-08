<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AriasRequest;
use App\Models\Aria;
use App\Models\Country;

class AriasController extends Controller
{
    public function index($countryId)
    {
        $data['arias'] = Aria::query()->where('country_id', $countryId)->get();
        $data['countryId'] = $countryId;
        return view('admin.arias.index', $data);
    }

    public function store(AriasRequest $request, $countryId)
    {
        Aria::create([
            'ar' => [
                'title' => $request->title_ar,
            ],
            'country_id' => $countryId,

        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($ariaId)
    {
        $data['aria'] = Aria::query()->find($ariaId);
        return view('admin.arias.edit', $data);
    }

    public function update(AriasRequest $request,$ariaId)
    {
        Aria::query()->find($ariaId)->update([
            'ar' => [
                'title' => $request->title_ar
            ]
        ]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function destroy($ariaId)
    {
        Aria::query()->find($ariaId)->delete();
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

}
