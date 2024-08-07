<?php

namespace App\Http\Controllers\Author;

use Auth;
use Storage;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\TagService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleFormRequest as StoreRequest;
use App\Http\Requests\ArticleFormRequest as UpdateRequest;

class AuthorArticleController extends Controller
{
    protected $articleService;
    protected $categoryService;
    protected $tagService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService,CategoryService $categoryService,TagService $tagService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        //
        $articles =  $this->articleService->authArticles();
        $title = 'Author Articles';

        return Inertia::render('Author/Articles/Index', compact('articles','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try{
            $categories = $this->categoryService->all();
            $tags = $this->tagService->all();
            $title = 'Create Article';

            return Inertia::render('Author/Articles/Create', compact('categories','tags','title'));
        } catch(Exception $e){
            return back()->with('error',ucwords('Something went wrong. Please try again'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //Store the article in DB
        try{
            $article = $this->articleService->createArticle($request);
            $tags = $request->tags;
            $article->tags()->sync($tags);

            return to_route('author.articles.index')->with('message',ucwords($article->title." ".'Article created successfully'));
        } catch(Exception $e){
            return back()->with('error',ucwords('An error occured while saving article'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            $article = $this->articleService->getId($id);
            $articleTags = $article->tags;
            $this->articleService->getId($id)->increment('total_views');
            $title = 'Author Article Details';

            return Inertia::render('Author/Articles/Show', compact('article','articleTags','title'));
        } catch(\Exception $e){
            return back()->with('error',ucwords('You have no sufficient permission to view this article'));
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit the article with the id
        try{
            $article = $this->articleService->getId($id);
            $categories = $this->categoryService->all();
            $tags = $this->tagService->all();
            $articleTags = $article->tags;
            $title = 'Author Edit Article';

            return Inertia::render('Author/Articles/Edit', compact('article','categories','tags','articleTags','title'));
        } catch(\Exception $e){
            return to_route('author.articles.index')->with('error',ucwords('You have no sufficient permission to view this page'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        //Update the article with the id
        try{
            $article = $this->articleService->getId($id);
            Storage::delete('/public/'.$article->image);
            $this->articleService->updateArticle($request,$id);
            $tags = $request->tags;
            $article->tags()->sync($tags);

            return to_route('author.articles.index')->with('message',ucwords($article->title." ".'Article updated successfully'));
        } catch(\Exception $e){
            return back()->with('error',ucwords('Something went wrong. Please try again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the article with image
        try{
            $article = $this->articleService->getId($id);
            Storage::delete('/public/'.$article->image);
            $this->articleService->deleteArticle($id);
            $article->tags()->detach();
            return to_route('author.articles.index')->with('message',ucwords($article->title." ".'Article deleted successfully'));
        } catch(\Exception $e){
            return back()->with('error',ucwords('Something went wrong. Please try again'));
        }
    }
}
