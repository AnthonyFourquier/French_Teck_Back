<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Validate_company;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProfilUserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        /* $this->middleware('auth'); */
    }
    public function index(Request $request)
    {
        //$t = $request->only('apiToken');
        $key = explode("=", $request->path());
        $t = $key[count($key) - 1];
        $user = User::where('apiToken', '=', $t)->first();
        if (!isset($user)) {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        Auth::loginUsingId($user->id, true);
        if (Auth::check()) {
            return Validate_company::all();
        } else {
            return response()->json(['error' => 'rzrz'], 403);
        }
        // test de route avec middlware auth a modifier pr voir uniquement la sacompany
        /*    return $request->user()->id; */
    }
}
