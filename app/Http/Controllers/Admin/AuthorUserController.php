<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\UserFormRequest as StoreRequest;
use App\Http\Requests\Auth\UserFormRequest as UpdateRequest;

class AuthorUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        //
        $authors = User::whereAssignedRole('author')->latest('id')->get();
        $title = "Author's List";

        return Inertia::render('Admin/Authors/Index',compact('authors','title'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Create Author';

        return Inertia::render('Admin/Authors/Create', compact('title'));
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
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $data['assigned_role'] = UserRoleEnum::Author;
        $author = User::create($data);
        $author->assignRole($data['assigned_role']);
     
        return to_route('admin.authors.index')->with('message',ucwords('The'." ".$author->assigned_role->value." ".'updated successfully'));
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
        $author = User::findOrFail($id);
        $title = 'Author Details';

        return Inertia::render('Admin/Authors/Show', compact('author','title'));
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
        $author = User::findOrFail($id);
        $title = 'Edit'.' '.$author->name.' '.'Details';

        return Inertia::render('Admin/Authors/Edit', compact('author','title'));
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
        $author = User::findOrFail($id);
        if(!$author){
            return to_route('admin.authors.index')->with('error',ucwords('Oops! An error occured. Try again later!'));
        }
        $data = $request->only('name','email');
        $author->update($data);
     
        return to_route('admin.authors.index')->with('message',ucwords('The'." ".$author->assigned_role->value." ".'updated successfully'));
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
        $author = User::findOrFail($id);
        if(!$author){
            return to_route('admin.authors.index')->with('error',ucwords('Oops! An error occured. Try again later!'));
        }
        $author->delete();
    
        return to_route('admin.authors.index')->with('message',ucwords('The'." ".$author->assigned_role->value." ".'deleted successfully'));
    }
}
