<?php

namespace App\Http\Controllers;

use App\Models\Banner;

class StructureController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')
            ->where('title', 'banner struktur organisasi')
            ->get();

        if ($banners->isEmpty()) {
            $banners = Banner::where('status', 'active')
                ->where('title', 'banner sejarah organisasi')
                ->get();
        }

        return view('frontend.about.structure', compact('banners'));
    }
}
