<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class VendorProfileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * Change password store
     */
    public function store(Request $request)
    {
        $request->validate([
            'old_password' => 'required|',
            'new_password' => 'required|confirmed',
//            'confirm_password' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->getAuthPassword()))
        {
            return back()->with('error', 'Old password doesn\'t match');
        }

        //Update new password

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('status', 'Password updated successfully!');
    }

    /**
     * Display the specified resource.
     * Display change password form
     */
    public function show()
    {
        return view('vendor.profile.change_password');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = Auth::user();

        return view('vendor.profile.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->file('photo'))
        {
            $img = $request->file('photo');
            $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(200, 200)->save('upload/vendor/profile/'.$filename);

            if (file_exists(Auth::user()->photo))
            {
                unlink('upload/vendor/profile/'.Auth::user()->photo);
            }
            User::findOrFail(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'vendor_join' => $request->vendor_join,
                'vendor_short_info' => $request->vendor_short_info,
                'photo' => $filename
            ]);

            return redirect()->back()->with([
                'message' => 'Vendor profile updated successfully!',
                'alert-type' => 'success'
            ]);
        }
        User::findOrFail(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'vendor_join' => $request->vendor_join,
            'vendor_short_info' => $request->vendor_short_info,
        ]);

        return redirect()->back()->with([
            'message' => 'Vendor profile updated successfully!',
            'alert-type' => 'success'
        ]);
    }
}
