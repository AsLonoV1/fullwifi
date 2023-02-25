<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth()->attempt($credentials, false)) {
            $client = new Client(['verify' => false]);
            try {
                $response = $client->post("http://fullwifi.loc/oauth/token", [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => config('services.passport.id'),
                        'client_secret' => config('services.passport.secret'),
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*'
                    ]
                ]);
                return json_decode($response->getBody());
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return response()->json(['errors' => 'password or login xato'], 401);
        }
    }


    public function refreshToken(Request $request)
    {
        $request->validate( [
            'refresh_token' => 'required|string'
        ]);
        $client = new Client();
        try {
            $response = $client->post("http://fullwifi.loc/oauth/token", [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $request->refresh_token,
                    'client_id' => config('services.passport.id'),
                    'client_secret' => config('services.passport.secret'),
                    'scope' => '',
                ]
            ]);
            
            return $response->getBody();
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage()]);
        }
    }
    
  
    public function logOut(Request $request){

        $request->user()->tokens()->delete();
        
        return response()->json([
            'logged out'
        ]);
    }
}
