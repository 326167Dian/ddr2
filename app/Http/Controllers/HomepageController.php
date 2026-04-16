<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Companysetting;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')->where('title', 'Banner Home')->get();
        $companyProfile = Companysetting::first();
        $articlesCount = Article::count();
        $activitiesCount = Kegiatan::count();
        $totalDonasiApproved = (int) DB::table('jurnal_kas')
            ->where('status', 'approved')
            ->sum('nominal');
        return view('frontend.homepage.index', compact('companyProfile', 'totalDonasiApproved', 'banners', 'activitiesCount', 'articlesCount'));
    }
}
