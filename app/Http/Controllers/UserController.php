<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('index', compact('data'));
    } //end method

    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->file('photo'))
        {
            $img = $request->file('photo');
//            unlink(public_path('upload/user/profile/'.Auth::user()->photo));
            $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(200, 200)->save('upload/user/profile/'.$filename);

            User::findOrFail(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $filename
            ]);

            return redirect()->back()->with([
                'message' => 'User profile updated successfully!',
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
            'message' => 'User profile updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function password(Request $request)
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

        return redirect()->back()->with([
            'status' => 'Password updated successfully!',
            'message' => 'User password updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with([
            'status' => 'User logout successfully!',
            'message' => 'User logout successfully!',
            'alert-type' => 'success'
        ]);
    }
}
