<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index', ['newsList'=>$news]);
    }

    public function show(int $id)
    {
        $news = $this->getNews( $id);
        return view('news.show', ['news' => $news]);
    }
}
