<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserLogs;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        $user = User::create($data);
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    public function login(Request $request, Agent $agent)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        UserLogs::create([
            'user_id' => Auth::user()->id,
            'login_at' => Carbon::now(),
            'login_ip' => $request->ip(),
            'login_os' => $agent->platform(),
            'login_token' => $token,
            'login_device' => $agent->device(),
            'login_browser' =>$agent->browser()
        ]);

        dump($token);

        return $this->respondWithToken($token);
    }

    public function logout(Request $request, Agent $agent)
    {
        $success = auth()->logout();

        dump($request->token);

        if (Auth::check()) {
            $log = UserLogs::where([
                'user_id' => Auth::user()->id,
                'token' => $request->token
            ])->first();

            dump($log);

            // $log = UserLogs::where(['user_id' => Auth::user()->id])
            //     ->order_by('updated_at', 'desc')->first();

            if ($log) {
                $log->logout_at = Carbon::now();
                $log->save();
            }
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
