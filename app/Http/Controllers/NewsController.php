<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()->paginate(6);
        return view('news.index', ['newsList'=>$news]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(News $news)
    {

        return view('news.show', ['news' => $news]);
    }
}
