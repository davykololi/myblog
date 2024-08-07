<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    //
    public function comments()
    {
        $comments = Comment::latest('id')->get();
        $title = "Clients Comments";
        return Inertia::render('Admin/Comments/Comments',compact('comments','title'));
    }

    public function deleteComments($id)
    {
        try{
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return back()->with('message','The Comment deleted successfully');
        } catch(error){
            throw new Error('An error occured. Please try again', error);
        }
    }
}
