<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Grosv\LaravelPasswordlessLogin\LoginUrl;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserLoginMail;
use App\Models\Company;
use App\Models\User;
use App\Models\Validate_users;
use Illuminate\Cache\Repository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Session\Middleware\StartSession;

class UserController extends Controller
{

    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();

        Validate_users::create($input);


        return response()->json(['success' => true], $this->successStatus);
    }

    public function login(Request $request)
    {
        $t = $request->only('apiToken');
        $user = User::where('apiToken', '=', $t)->first();
        if (isset($user)) {
            Auth::loginUsingId($user->id, true);
            if ($user->role == 2) {
                return response()->json(['success' => true, $this->successStatus, 'role' => 2]);
            } else {
                return response()->json(['success' => true, $this->successStatus, 'role' => 1]);
            }
        } else return response()->json(['error' => 'Unauthorised'], 401);
    }

    function sendLoginLink(Request $request)
    {

        $email = $request->get('email');
        $user = User::where('email', '=', $email)->first();

        if (empty($user)) {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
        $generator = new LoginUrl($user);
        $data['user'] = $user;
        $d = $generator->generate();
        $key = explode("=", $d);
        $user->apiToken = $key[count($key) - 1];
        $data['url'] = "http://192.168.1.25:8080/?t=" . $user->apiToken;
        $user->save();


        Mail::to($user->email)->send(new UserLoginMail($data));

        return response()->json(['success' => true], $this->successStatus);
    }

    public function checklogin(Request $request)
    {

        $user = $request->token;
        if (Auth::check($user)) {
            /* Auth::login($user); */
            return response()->json(['success' => true, $this->successStatus]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function dashboardcompanies()
    {
        return Company::All();
    }
    public function dashboardusers()
    {
        return User::All();
    }

    public function logout(Request $request)
    {
        $apiToken = $request->only('apiToken');
        $user = User::where('apiToken', '=', $apiToken)->first();
        $user->apiToken = '';
        $user->save();
    }
}
