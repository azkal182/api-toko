<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
 use Illuminate\Support\Facades\Http;
use App\User;
use Validator;

// use GuzzleHttp\Client;

class UserController extends Controller
{

   
    public $successStatus = 200;

    /**
     * Login - API
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Registrasi Pengguna Baru - API
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * Rincian Pengguna Login - API
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function loginf(request $request) 
    {
        //return $request;
        // $http = new GuzzleHttp\Client;

        // $response = $http->post('http://127.0.0.1:8000/oauth/token', [
        //     'form_params' => [
        //         'grant_type' => 'password',
        //         'client_id' => 'client-id',
        //         'client_secret' => 'client-secret',
        //         'username' => 'taylor@laravel.com',
        //         'password' => 'my-password',
        //         'scope' => '',
        //     ],
        // ]);

        // return json_decode((string) $response->getBody(), true);

        try {
            //code...
            // $http = new \GuzzleHttp\Client;
            // $client = new Client();
            // $http = new Client();

        $response = Http::post('http://127.0.0.1:8000/api/public/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '1',
                'client_secret' => 'A71BMMLzE8BHlrXgMo2RXmRm8AZlJWzuQIZJaRAb',
                'username' => $request->username,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\BadResponseExceptions $th) {
            //throw $th;
            return response()->json('error', $th()->getCode());
        }
    }
}