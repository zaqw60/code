<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use App\Queries\NewsQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(NewsQueryBuilder $builder)
    {
        $news = News::all();
        return view('admin.news.index', ['newsList'=>$builder->getNews()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $sources = Source::all();
        return view('admin.news.create', [
            'categories'=>$categories,
            'sources'=>$sources
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param NewsQueryBuilder $builder
     * @return RedirectResponse
     */
    public function store(Request $request, NewsQueryBuilder $builder): RedirectResponse
    {
        $news = $builder->create(
            $request->only([
                'category_id',
                'source_id',
                'title',
                'author',
                'status',
                'image',
                'description'
            ])
        );
        if ($news){
            return redirect()->route('admin.news.index')
                ->with('success', 'Новость добавлена');
        }
        return back('error', 'Не удалось добавить новость');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Admin Some News Show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        $sources = Source::all();
        return view('admin.news.edit', [
            'news'=> $news,
            'categories'=>$categories,
            'sources'=>$sources
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @param NewsQueryBuilder $builder
     * @return RedirectResponse
     */
    public function update(Request $request, News $news, NewsQueryBuilder $builder): RedirectResponse
    {
        if ($builder->update($news, $request->only($request->only(['category_id', 'source_id', 'title', 'author', 'status', 'image', 'description']))))
        {
                return redirect()->route('admin.news.index')
                    ->with('success', 'Новость обновлена');
        }
            return back('error', 'Не удалось обновить новость');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
