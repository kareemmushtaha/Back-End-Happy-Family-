<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Package;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{

    public function index()
    {
        //abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packages = Package::query()->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function edit(Package $package)
    {
      //  abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package_status = Package::STATUS;

        return view('admin.packages.edit', compact('package', 'package_status'));
    }

    public function update(PackageRequest $request, $package_id)
    {
        $package = Package::query()->findOrFail($package_id);

        $data = [
            'ar' => [
                'title' => $request->title,
                'description' => $request->description,
                'subscription_features' => $request->subscription_features,
            ],

            'price' => $request->price,
            'status' => $request->status,
        ];

        $package->update($data);

        toastr()->success(trans('global.update_success'));

        return redirect()->route('admin.packages.index');
       // return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show(Package $package)
    {
        //abort_if(Gate::denies('package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.packages.show', compact('package'));
    }



}
