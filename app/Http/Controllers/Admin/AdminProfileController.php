<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

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
        return view('admin.profile.change_password');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $adminData = Auth::user();

        return view('admin.profile.index', compact('adminData'));
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
            unlink(public_path('upload/admin/profile/'.Auth::user()->photo));
            $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(200, 200)->save('upload/admin/profile/'.$filename);

            User::findOrFail(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $filename
            ]);

            return redirect()->back()->with([
                'message' => 'Admin profile updated successfully!',
                'alert-type' => 'success'
            ]);
        }
        User::findOrFail(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with([
            'message' => 'Admin profile updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
