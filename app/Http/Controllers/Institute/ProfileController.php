<?php

namespace App\Http\Controllers\Institute;

use App\Institute\Profile;
use Inoplate\Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getIndex()
    {
        $profile = Profile::where('id', '!=', null)->first();

        return view('institute.profile.index', compact('profile'));
    }

    public function putUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:255'
        ]);

        $profile = Profile::where('id', '!=', null)->first() ?: new Profile;
        $profile->name = $request->name;
        $profile->code = $request->code;
        $profile->avatar = $request->avatar;
        $profile->website = $request->website;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->alternate_address = $request->alternate_address;
        $profile->sub_district = $request->sub_district ?: ':p';
        $profile->deed_date = $request->deed_date;
        $profile->deed_number = $request->deed_number;
        $profile->founded_on = $request->founded_on;

        $profile->save();

        return $this->formSuccess(
            route(
                'institute.admin.profile.index.get'), 
                ['message' => 'Profil instansi berhasil disimpan.']);
    }
}