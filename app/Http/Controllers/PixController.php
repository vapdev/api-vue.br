<?php

namespace App\Http\Controllers;

use App\Models\Pix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PixController extends Controller
{
    public function index()
    {
        $pixes = Pix::all();
        return response()->json(['pixes' => $pixes], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_video_id' => 'required|exists:course_videos,id',
            'pix_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pix = Pix::create($validator->validated());

        return response()->json(['pix' => $pix], 201);
    }

    public function show(Pix $pix)
    {
        return response()->json(['pix' => $pix], 200);
    }

    public function update(Request $request, Pix $pix)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_video_id' => 'required|exists:course_videos,id',
            'pix_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pix->update($validator->validated());

        return response()->json(['pix' => $pix], 200);
    }

    public function destroy(Pix $pix)
    {
        $pix->delete();

        return response()->json(['message' => 'Pix deleted successfully'], 200);
    }
}
