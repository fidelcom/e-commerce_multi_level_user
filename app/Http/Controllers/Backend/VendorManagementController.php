<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorManagementController extends Controller
{
    public function inactive()
    {
        $data = User::where([
            'role' => 'vendor'
        ])->latest()->get();

        return view('backend.vendor.inactive', compact('data'));
    }

    public function active()
    {
        $data = User::where([
            'role' => 'vendor',
        ])->latest()->get();

        return view('backend.vendor.active', compact('data'));
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('backend.vendor.show', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        if ($request->status == 'inactive')
        {
            User::where('id', $id)->update([
                'status' => 'active'
            ]);

            return redirect()->route('active.vendor')->with([
                'message' => 'Vendor status activated successfully!'
            ]);
        }else{
            User::where('id', $id)->update([
                'status' => 'inactive'
            ]);

            return redirect()->route('inactive.vendor')->with([
                'message' => 'Vendor status deactivated successfully!'
            ]);
        }


    }
}
