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
        $listArticles = ArticleRepository::listArticles();
        dd($listArticles);
        return view('index', compact('listArticles'));
    }

    /**
     * Show the form for creating a new article.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): Response
    {
        //
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
