<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Validate_company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ValidateCompanyMail;
use App\Models\User;


class ValidateCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Validate_company::all(); // a modifier affichier la company du  user
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apiToken = $request->only('apiToken');
        $user = User::where('apiToken', '=', $apiToken)->first();
        $id = $user->id;

        $validate_company = new Validate_company();
        $validate_company->name = $request->name;
        $validate_company->address = $request->address;
        $validate_company->facebook = $request->facebook;
        $validate_company->linkedin = $request->linkedin;
        $validate_company->twitter = $request->twitter;
        $validate_company->instagram = $request->instagram;
        $validate_company->category = $request->category;
        $validate_company->association = $request->association;
        $validate_company->description = $request->description;
        $validate_company->website = $request->website;
        $validate_company->mail = $request->mail;
        $validate_company->tel = $request->tel;
        $validate_company->activity = $request->activity;
        $validate_company->fund_raising = $request->fund_raising;
        $validate_company->employees = $request->employees;
        $validate_company->recrutement = $request->recrutement;
        $validate_company->women = $request->women;
        $validate_company->ca = $request->ca;
        $validate_company->postcode = $request->postcode;
        $validate_company->user_id = $id;
        $address = urlencode($request->address);
        $postcode = $request->postcode;
        $url = 'https://api-adresse.data.gouv.fr/search/?q=' . $address . '&postcode=' . $postcode;
        $res = file_get_contents($url);
        $content = json_decode($res, true);

        foreach ($content["features"] as  $elements) {
            $res =  $elements;
        }

        $validate_company->coordinate_x = $res["geometry"]["coordinates"][0];
        $validate_company->coordinate_y = $res["geometry"]["coordinates"][1];
        $validate_company->save();

        return response()->json(['success' => true], 200);
    }


    public function update(Request $request, Validate_company $validate_company)
    {
        $validate_company->update($request->all()); // a tester
    }


    public function destroy(Request $request, Validate_company $validate_company)
    {
        $id = $request->only('id');
        $validate_users = Validate_company::where('id', '=', $id)->first();
        $validate_users->delete($id);
        return response()->json(['success' => true], 200);
    }
    public function validatecompany(Request $request)
    {

        $id = $request->only('id');
        $validate_company = Validate_company::where('id', '=', $id)->first();
        $company = new Company();
        $company->name = $validate_company->name;
        $company->address = $validate_company->address;
        $company->facebook = $validate_company->facebook;
        $company->linkedin = $validate_company->linkedin;
        $company->twitter = $validate_company->twitter;
        $company->instagram = $validate_company->instagram;
        $company->category = $validate_company->category;
        $company->association = $validate_company->association;
        $company->description = $validate_company->description;
        $company->website = $validate_company->website;
        $company->mail = $validate_company->mail;
        $company->tel = $validate_company->tel;
        $company->activity = $validate_company->activity;
        $company->fund_raising = $validate_company->fund_raising;
        $company->employees = $validate_company->employees;
        $company->recrutement = $validate_company->recrutement;
        $company->women = $validate_company->women;
        $company->ca = $validate_company->ca;
        $company->postcode = $validate_company->postcode;
        $company->coordinate_x = $validate_company->coordinate_x;
        $company->coordinate_y = $validate_company->coordinate_y;
        $company->user_id = $validate_company->user_id;
        /* Mail::to($company->mail)->send(new ValidateCompanyMail()); */
        $company->save();

        $validate_company->destroy($id);

        return response()->json(['success' => true], 200);
    }
}
