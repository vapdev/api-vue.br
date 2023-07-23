<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Google_Client;

class GoogleAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);
        $id_token = $request->id_token;

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            $userid = $payload['sub'];
            $user = User::where('provider_id', $userid)->where('provider', 'google')->first();
            if (!$user) {
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'provider' => 'google',
                    'provider_id' => $userid,
                ]);
            }
            return response()->json([
                'message' => 'Successfully logged in',
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }
}