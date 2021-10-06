<?php

namespace App\Http\Controllers;

use App\Models\Validate_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ValidateCompanyMail;
use App\Models\User;

class ValidateUserController extends Controller
{

    public function index()
    {
        return Validate_users::all();
    }

    public function destroy(Request $request, Validate_users $validate_users)
    {
        $id = $request->only('id');
        $validate_users = Validate_users::where('id', '=', $id)->first();
        $validate_users->destroy($id);
        return response()->json(['success' => true], 200);
    }
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

        return response()->json(['success' => true], 200);
    }
    public function validateuser(Request $request)
    {
        $id = $request->only('id');
        $validate_users = Validate_users::where('id', '=', $id)->first();
        $users = new User();
        $users->email = $validate_users->email;
        /* Mail::to($users->mail)->send(new ValidateCompanyMail()); */
        $users->save();

        $validate_users->destroy($id);

        return response()->json(['success' => true], 200);
    }
}
