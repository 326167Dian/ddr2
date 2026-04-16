<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')->where('title', 'banner kegiatan')->get();
        $activities = Kegiatan::with('bidang')->whereIn('status', ['berjalan', 'selesai'])->orderBy('tanggal_mulai', 'desc')->paginate(6);
        return view('frontend.news.activity', compact('activities', 'banners'));
    }

    public function show(Kegiatan $activity)
    {
        return view('frontend.news.show-activity', compact('activity'));
    }
}
