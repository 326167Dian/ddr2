<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Companysetting;
use App\Models\Kegiatan;

class HomepageController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')->where('title', 'banner home')->get();
        $companyProfile = Companysetting::first();
        $articlesCount = Article::count();
        $activitiesCount = Kegiatan::count();
        return view('frontend.homepage.index', compact('companyProfile', 'banners', 'activitiesCount', 'articlesCount'));
    }
}
