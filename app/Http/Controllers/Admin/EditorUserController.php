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

class EditorUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        //
        $editors = User::whereAssignedRole('editor')->latest('id')->get();
        $title = "Editors's List";

        return Inertia::render('Admin/Editors/Index', compact('editors','title'))
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
        $title = 'Create Editor';

        return Inertia::render('Admin/Editors/Create', compact('title'));
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
        $data['assigned_role'] = UserRoleEnum::Editor;
        $editor = User::create($data);
        $editor->assignRole($data['assigned_role']);
     
        return to_route('admin.editors.index')->with('message',ucwords('The'." ".$editor->assigned_role->value." ".'created successfully'));
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
        $editor = User::findOrFail($id);
        $title = 'Editor Details';

        return Inertia::render('Admin/Editors/Show', compact('editor','title'));
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
        $editor = User::findOrFail($id);
        $title = 'Edit'.' '.$editor->name.' '.'Details';

        return Inertia::render('Admin/Editors/Edit', compact('editor','title'));
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
        $editor = User::findOrFail($id);
        if(!$editor){
            return to_route('admin.editors.index')->with('error',ucwords('Oops! An error occured. Try again later!'));
        }
        $data = $request->only('name','email');
        $editor->update($data);
     
        return to_route('admin.editors.index')->with('message',ucwords('The'." ".$editor->assigned_role->value." ".'updated successfully'));
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
        $editor = User::findOrFail($id);
        if(!$editor){
            return to_route('admin.editors.index')->with('error',ucwords('Oops! An error occured. Try again later!'));
        }
        $editor->delete();
    
        return to_route('admin.editors.index')->with('message',ucwords('The'." ".$editor->assigned_role->value." ".'deleted successfully'));
    }
}
