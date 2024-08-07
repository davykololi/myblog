<?php

namespace App\Http\Controllers\Editor;

use Auth;
use Storage;
use Inertia\Inertia;
use App\Models\User;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\TagService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleFormRequest as UpdateRequest;

class EditorArticleController extends Controller
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
    public function index()
    {
        //
        try{
            $articles =  $this->articleService->paginate(2); 
            $title = 'Editor View Articles';
        
            return Inertia::render('Editor/Articles/Index',compact('articles','title'));
        } catch(\Exception $e){
            return to_route('editor.articles.index')->with('error',ucwords('Something went wrong. Please try again'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $title = 'Editor View Article';
            
            return Inertia::render('Editor/Articles/Show',compact('article','title','articleTags'));
        } catch(\Exception $e){
            return redirect()->route('editor.articles.index')->with('error',ucwords('You have no sufficient permission to view this article'));
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
        //
        try{
            $article = $this->articleService->getId($id);
            $categories = $this->categoryService->all();
            $tags = $this->tagService->all();
            $articleTags = $article->tags;
            $authors = User::where('assigned_role','author')->get();
            $title = 'Editor Edit Article';

            return Inertia::render('Editor/Articles/Edit',compact('article','categories','tags','articleTags','authors','title')); 
        } catch(\Exception $e){
            return redirect()->route('editor.articles.index')->with('error',ucwords('You have no sufficient permission to view this article'));
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
        try{
            $article = $this->articleService->getId($id);
            Storage::delete('/public/'.$article->image);
            $this->articleService->updateArticle($request,$id);
            $tags = $request->tags;
            $article->tags()->sync($tags);

            return to_route('editor.articles.index')->with('message',ucwords($article->title." ".'Article updated successfully'));
        } catch(\Exception $e){
            return back()->with('error',ucwords('An error occured. Please try again.')); 
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
        //Delete article with featured image
        try{
            $article = $this->articleService->getId($id);
            Storage::delete('/public/'.$article->image);
            $this->articleService->deleteArticle($id);
            $article->detachTags();
            return to_route('editor.articles.index')->with('message',ucwords($article->title." ".'Article deleted successfully'));
        } catch(\Exception $e){
            return to_route('editor.articles.index')->with('error',ucwords('Something went wrong. Please try again'));
        }
    }
}
