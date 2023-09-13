<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    //vendor_dashboard

    public function index()
    {
        return view('vendor.vendor_dashboard');
    }
}
