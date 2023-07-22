<?php

namespace App\Http\Controllers;

use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseVideoController extends Controller
{
    public function index()
    {
        $courseVideos = CourseVideo::all();
        return response()->json(['course_videos' => $courseVideos], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'is_paid' => 'boolean',
            'view_count' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $courseVideo = CourseVideo::create($validator->validated());

        return response()->json(['course_video' => $courseVideo], 201);
    }

    public function show(CourseVideo $courseVideo)
    {
        return response()->json(['course_video' => $courseVideo], 200);
    }

    public function update(Request $request, CourseVideo $courseVideo)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'is_paid' => 'boolean',
            'view_count' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $courseVideo->update($validator->validated());

        return response()->json(['course_video' => $courseVideo], 200);
    }

    public function destroy(CourseVideo $courseVideo)
    {
        $courseVideo->delete();

        return response()->json(['message' => 'Course video deleted successfully'], 200);
    }
}
