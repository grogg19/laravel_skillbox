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
        $title = 'Главная';

        return view('index', compact('articles', 'title'));
    }

    /**
     * Show the form for creating a new article.
     * @return View
     */
    public function create(): View
    {
        $title = 'Создание статьи';
        return view('articles.create', compact('title'));
    }

    /**
     * Store a newly created article in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->merge([
            'is_published' => $request->boolean('is_published'),
        ]);

        $rules = [
            'title' => 'required|unique:articles|min:5|max:100',
            'slug' => 'required|unique:articles',
            'excerpt' => 'required|max:255',
            'body' => 'required',
        ];


        $this->validate($request, $rules);

        //dd($request->post());
        ArticleRepository::createArticle($request->post());


        return redirect('/');
    }

    /**
     * Display the specified article.
     *
     * @param  string  $slug
     */
    public function show($slug)
    {
        $article = ArticleRepository::getArticleBySlug($slug);

        $title = 'Статья | ' . $article->title;

        return view('articles.show', compact('article', 'title'));
    }
}
