<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountriesRequest;
use App\Models\Country;

class CountriesController extends Controller
{
    public function index()
    {
        $data['countries'] = Country::query()->get();
        return view('admin.countries.index', $data);
    }

    public function store(CountriesRequest $request)
    {
        Country::create([
            'ar' => [
                'title' => $request->title_ar
            ]
        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($countryId)
    {
        $data['country'] = Country::query()->find($countryId);
        return view('admin.countries.edit', $data);
    }

    public function update(CountriesRequest $request,$countryId)
    {
        Country::query()->find($countryId)->update([
            'ar' => [
                'title' => $request->title_ar
            ]
        ]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function destroy($countryId)
    {
        Country::query()->find($countryId)->delete();
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
