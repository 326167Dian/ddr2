<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')->where('title', 'banner sejarah organisasi')->get();
        return view('frontend.about.history', compact('banners'));
    }
}
