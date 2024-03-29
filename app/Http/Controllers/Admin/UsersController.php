<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpgradeSubscriptionRequest;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Package;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPackage;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\lessThanOrEqual;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::with(['roles'])->get();
        $roles = Role::pluck('title', 'id');

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->delete();
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }

    public function changePassword()
    {
        if (Auth::user()->roles->contains('id', 1) == 1) {
            return view('admin.users.changePassword');
        }
        toastr()->error(trans('global.sorry_some_error'), trans('global.error'));
        return redirect()->route('admin.home');
    }

    public function saveChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ], [

            'password.required' => __('cruds.user.password_required'),
            'password_confirmation.required' => __('cruds.user.password_confirmation_required'),
            'password.confirmed' => __('cruds.user.password_confirmation_equalTo'),
            'password.min' => __('cruds.user.password_minlength'),
        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => __('cruds.user.Password_updated_successfully'),
        ]);
    }

    public function changeStatus(Request $request)
    {
        if ($request->check_active == 0) {
            $check_active = 1;
        } else {
            $check_active = 0;
        }

        $user = User::query()->findOrFail($request->user_id);
        if ($user->getType() == "mediator") {
            $data = [
                 'check_active_mediator' => $check_active
            ];
        } else {
            $data = [
                'check_active' => $check_active,
            ];
        }


        $user->update($data);
        return response()->json([
            'status' => true,
            'check_active' => $check_active,
            'msg' => 'تم تغيير حالة المستخدم بنجاح',
        ]);
    }


    public function upgradeSubscription(UpgradeSubscriptionRequest $request, $userId)
    {
        $user = User::query()->findOrFail($userId);

        $package = Package::query()->first();
        if (!checkUserHaveSubscription($user->id)) {
            UserPackage::query()->create([
                'package_id' => $package->id,
                'user_id' => $user->id,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_subscription_date,
                'status' => 1, //subscription is not active
                'is_free' => 0,
                'added_by_manager' => 1,
            ]);
            return response()->json(['status' => true, 'msg' => trans('global.upgrade_subscription_success')]);
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_you_have_package_activated')]);
        }
    }

}
