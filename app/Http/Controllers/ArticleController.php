<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Banner;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')->where('title', 'banner artikel & berita')->get();
        $articles = Article::orderBy('published_at', 'desc')->paginate(6);
        return view('frontend.news.news', compact('articles', 'banners'));
    }

    public function show(Article $article)
    {
        return view('frontend.news.show-news', compact('article'));
    }
}
