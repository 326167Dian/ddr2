<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')->where('title', 'banner struktur organisasi')->get();
        return view('frontend.about.structure', compact('banners'));
    }
}
