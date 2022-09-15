<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use App\Queries\NewsQueryBuilder;
use App\Services\UploadService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;



class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(NewsQueryBuilder $builder)
    {
        return view('admin.news.index', ['newsList'=>$builder->getNews()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @param CreateRequest $request
     * @param NewsQueryBuilder $builder
     * @return RedirectResponse
     */
    public function store(
        CreateRequest $request,
        NewsQueryBuilder $builder
    ): RedirectResponse {
        $news = $builder->create(
            $request->validated()
        );
        if ($news){
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.create.success'));
        }
        return back('error', __('messages.admin.news.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return string
     */
    public function show(int $id): string
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
     * @param EditRequest $request
     * @param News $news
     * @param NewsQueryBuilder $builder
     * @return RedirectResponse
     */
    public function update(
        EditRequest $request,
        News $news,
        NewsQueryBuilder $builder,
        UploadService $uploadService
    ): RedirectResponse {
        $validated = $request->validated();

        if ($request->hasFile('image')){
            $validated['image'] = $uploadService->uploadImage($request->file('image'));
        }
        if ($builder->update($news, $validated))
        {
                return redirect()->route('admin.news.index')
                    ->with('success', __('messages.admin.news.update.success'));
        }
            return back('error', __('messages.admin.news.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return JsonResponse
     */
    public function destroy(News $news): JsonResponse
    {
        try {
           $deleted = $news->delete();
           if ($deleted === false) {
               return \response()->json('error', 400);
           }
           return \response()->json('ok');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return \response()->json( 'error', 400);
        }
    }
}
