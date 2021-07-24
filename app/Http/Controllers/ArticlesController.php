<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the articles.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = ArticleRepository::listArticles();

        return view('index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     * @return View
     */
    public function create(): View
    {
        return view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->boolean('isPublished');
        $rules = [
            'title' => 'required|unique:articles|min:5|max:100',
            'slug' => 'required|unique:articles',
            'excerpt' => 'required|max:255',
            'body' => 'required',
        ];

        $result = $this->validate($request, $rules);
        ArticleRepository::createArticle($result);

        return redirect('/');
    }

    /**
     * Display the specified article.
     *
     * @param  string  $slug
     */
    public function show($slug)
    {
        return ArticleRepository::getArticleBySlug($slug);
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id): Response
    {
        //
    }

    /**
     * Update the specified article in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
    }
}
