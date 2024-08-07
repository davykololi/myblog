<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Services\CategoryService;
use App\Http\Requests\CategoryFormRequest as StoreRequest;
use App\Http\Requests\CategoryFormRequest as UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = $this->categoryService->all();
        $title = 'Categories';

        return Inertia::render('Admin/Categories/Index', compact('categories','title'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Create Category';
        return Inertia::render('Admin/Categories/Create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //
        $category = $this->categoryService->create($request);
        if(!$category){
            return redirect()->route('admin.categories.index')->with('error',ucwords('Oops! An error occured, Please try again later'));
        }

        return to_route('admin.categories.index')->with('message',ucwords($category->name." ".'Category created successfully'));
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
        $category = $this->categoryService->getId($id);
        $title = 'Category Details';

        return Inertia::render('Admin/Categories/Show', compact('category','title'));
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
        $category = $this->categoryService->getId($id);
        $title = 'Edit Category';

        return Inertia('Admin/Categories/Edit', compact('category','title'));
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
        //
        $category = $this->categoryService->getId($id);
        if(!$category){
            return redirect()->route('admin.categories.index')->with('error',ucwords('Oops! An error occured, Please try again later'));
        }
        $this->categoryService->update($request,$id);

        return to_route('admin.categories.index')->with('message',ucwords($category->name." ".'Category updated successfully'));
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
        $category = $this->categoryService->getId($id);
        if(!$category){
            return redirect()->route('admin.categories.index')->with('error',ucwords('Oops! An error occured, Please try again later'));
        }
        $this->categoryService->delete($id);

        return redirect()->route('admin.categories.index')->with('message',ucwords($category->name." ".'Category deleted successfully'));
    }
}
