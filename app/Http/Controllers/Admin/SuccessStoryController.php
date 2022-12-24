<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SuccessStoryRequest;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['success_stories'] = SuccessStory::query()->get();
        return view('admin.success_stories.index', $data);
    }


    public function create()
    {
        $data['success_stories_status'] = SuccessStory::STATUS;
        return view('admin.success_stories.create', $data);

    }

    public function store(SuccessStoryRequest $request)
    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $file = '';
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/successStory', $file);
        }

        SuccessStory::query()->create([
            'ar' => [
                'title' => $request->title,
                'description' => $request->description,
            ],
            'name' => $request->name,
            'status' => $request->status,
            'photo' => $file,
        ]);


        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function edit($story_id)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $story = SuccessStory::query()->findOrFail($story_id);

        $data['success_stories_status'] = SuccessStory::STATUS;

        return view('admin.success_stories.edit', compact('story'), $data);

    }

    public function update(SuccessStoryRequest $request, $story_id)
    {

        $story = SuccessStory::query()->findOrFail($story_id);

        $file = '';
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/successStory', $file);

            $data = [
                'ar' => [
                    'title' => $request->title,
                    'description' => $request->description,
                ],
                'name' => $request->name,
                'status' => $request->status,
                'photo' => $file,
            ];

        } else {
            $data = [
                'ar' => [
                    'title' => $request->title,
                    'description' => $request->description,
                ],
                'name' => $request->name,
                'status' => $request->status,
            ];
        }

        $story->update($data);

        toastr()->success(trans('global.update_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($story_id)
    {
//        abort_if(Gate::denies('lesson_step_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $story = SuccessStory::query()->findOrFail($story_id);
        return view('admin.success_stories.show', compact('story'));
    }

    public function destroy($story_id)
    {
//        abort_if(Gate::denies('lesson_step_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $story = SuccessStory::query()->findOrFail($story_id);

        if (!$story) {
            return response()->json(['status' => true, 'msg' => trans('global.data_not_found')]);
        } else {
            $story->translations()->delete();
            $story->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }
}
