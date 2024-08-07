<?php

namespace App\Http\Controllers\Guests;

use Auth;
use Innertia\Innertia;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function articleCommentForm()
    {

        return Innertia::render('Partials/Comments/CommentForm');
    }

    public function articleComment(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['article_id'] = $request->article_id;

        Comment::create($input);

        return back()->with('message','Thank you for your comment. We value your feedback');
    }
}
