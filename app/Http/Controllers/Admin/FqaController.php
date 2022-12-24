<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FqaRequest;
use App\Http\Requests\Admin\SuccessStoryRequest;
use App\Models\Fqa;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class FqaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['fqas'] = Fqa::query()->get();
        return view('admin.fqa.index', $data);
    }


    public function create()
    {
        $data['fqa_status'] = Fqa::STATUS;
        return view('admin.fqa.create', $data);

    }

    public function store(FqaRequest $request)
    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Fqa::query()->create([
            'ar' => [
                'question' => $request->question,
                'answer' => $request->answer,
            ],

            'status' => $request->status,
        ]);


        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($fqa_id)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fqa = Fqa::query()->findOrFail($fqa_id);
        $data['fqa_status'] = Fqa::STATUS;
        return view('admin.fqa.edit', compact('fqa'), $data);

    }

    public function update(FqaRequest $request, $fqa_id)
    {

        $fqa = Fqa::query()->findOrFail($fqa_id);

        $data = [
            'ar' => [
                'question' => $request->question,
                'answer' => $request->answer,
            ],

            'status' => $request->status,
        ];


        $fqa->update($data);

        toastr()->success(trans('global.update_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($fqa_id)
    {
//        abort_if(Gate::denies('lesson_step_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fqa = Fqa::query()->findOrFail($fqa_id);
        return view('admin.fqa.show', compact('fqa'));
    }

    public function destroy($fqa_id)
    {
//        abort_if(Gate::denies('lesson_step_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fqa = Fqa::query()->findOrFail($fqa_id);

        if (!$fqa) {
            return response()->json(['status' => true, 'msg' => trans('global.data_not_found')]);
        } else {
            $fqa->translations()->delete();
            $fqa->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }
}
