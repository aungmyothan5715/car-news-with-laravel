<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentValidate;//This is for comment create form validation method.
use Illuminate\Support\Facades\Gate;// Don't forget this import for Gate allows.

class CommentController extends Controller
{
    public function index()
    {
        return view('detail', ['comments' => 'Controller Comment']);
    }

    public function create(CommentValidate $request)
    {

        //dd($request->all());
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->user_name = $request->user_name;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();
        return back()->with('cmt-add', 'Your comment was submitted.');
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        
        if(Gate::allows('comment-delete')){
            $comment->delete();
            return back()->with('cmt-del', "Your comment was deleted successfully.");
        }else{
            return back()->with('error', 'Unauthorize!');
        }
    }
}
