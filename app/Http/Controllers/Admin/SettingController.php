<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index ()
    {
        return view('admin.settings.index');
    }

    public function saveSetting (Request $request)
    {
        $request_all = $request->except( '_token', 'local');

        foreach ($request_all as $item => $data) {

            if ($data == null) {
                toastr()->error('العنصر ( '. "$item". ' ) مطلوب. يرجى التأكد من صحة الداتا  ');
                return redirect()->route('admin.settings.index');
               // return response()->json(['status' => false, 'msg' => " العنصر " . " $item " . "مطلوب", "title" => "يرجى التأكد من صحة الداتا"]);
            }

            $setting_row = Setting::query()->where('key', "$item")
                ->first();

            $setting_row->update([
                "$request->local" => [
                    'value' => $data,
                ]]);
        }

        toastr()->success(trans('cruds.setting.settings_save_successfully'));
        return redirect()->route('admin.settings.index');
    }
}
