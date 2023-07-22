<?php

namespace App\Http\Controllers;

use App\Models\UserCourseHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserCourseHistoryController extends Controller
{
    public function index()
    {
        $userCourseHistories = UserCourseHistory::all();
        return response()->json(['user_course_histories' => $userCourseHistories], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_video_id' => 'required|exists:course_videos,id',
            'watched' => 'boolean',
            'paid' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $userCourseHistory = UserCourseHistory::create($validator->validated());

        return response()->json(['user_course_history' => $userCourseHistory], 201);
    }

    public function show(UserCourseHistory $userCourseHistory)
    {
        return response()->json(['user_course_history' => $userCourseHistory], 200);
    }

    public function update(Request $request, UserCourseHistory $userCourseHistory)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_video_id' => 'required|exists:course_videos,id',
            'watched' => 'boolean',
            'paid' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $userCourseHistory->update($validator->validated());

        return response()->json(['user_course_history' => $userCourseHistory], 200);
    }

    public function destroy(UserCourseHistory $userCourseHistory)
    {
        $userCourseHistory->delete();

        return response()->json(['message' => 'User course history deleted successfully'], 200);
    }
}
