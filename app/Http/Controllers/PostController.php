<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // Don't forget Import this.
use Illuminate\Support\Facades\Storage; // Don't forget Import this for delete in Storage forder.
use App\Http\Requests\PostValidate; // Don't forget this is for Validation form request for post.// If suddently 404 page authorize() return true. 
use Illuminate\Support\Facades\Gate;// Don't forget this for Gate Allows.

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }
    public function index()
    {
        //$posts = Post::orderBy('id', 'desc')->get();
        $posts = Post::latest()->paginate(6);

        //dd($posts);
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostValidate $request)
    {
        if(Gate::allows('post-create')){

        
            
            if($request->hasFile('cover')){
                $cover = time() . "_" . $request->file('cover')->getClientOriginalName();
                $request->file('cover')->storeAs('Upload', $cover);
            }

            $post = new Post();
            $post->title = $request->title;
            $post->exception = $request->exception;
            $post->body = $request->body;
            $post->cover_name = $cover;
            $post->save();   
            
            return redirect('/posts')->with('status', 'Post was added successfully');
        }else{
            return redirect('/posts')->with('error', 'Post can create only Admin!!!');
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
        $post = Post::findOrFail($id);
       // dd($post);
        return view('detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        //dd($post->cover_name);
        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostValidate $request, $id)
    {
        $post= Post::findOrFail($id);
        if(Gate::allows('post-update')){
            if($request->hasFile('cover')){
                $cover = time() . "_" . $request->file('cover')->getClientOriginalName();
                $request->file('cover')->storeAs('Upload', $cover);
            }

            $post->title = $request->title;
            $post->exception = $request->exception;
            $post->body = $request->body;
            $post->cover_name = $cover;
            $post->save();
            
            return redirect('/posts')->with('status', 'Post was update successfully');
        }else{
            return redirect('/posts')->with('error', 'Post can update only Admin!!!');
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
        $post = Post::findOrFail($id);
        if(Gate::allows('post-delete')){
            Storage::delete('Upload/' . $post->cover_name);
            $post->delete();
            return redirect('/posts')->with('status', 'Post was deleted successfully.');
        }else{
            return back()->with('error', 'Post can delete only Admin!!!');
        }
    }
}
