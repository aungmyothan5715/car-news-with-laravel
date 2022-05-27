@extends('layouts.app')

@section('content')
<div class="container">

    
    <div class="row">
        <div class="card col-md-8" style="margin:none;border:none;">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card bg-dark text-white" style="margin:none;border:none;">
                <div class="card-body">
                    
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <small>{{ $post->created_at->diffForHumans() }}</small><br>
                    @if( auth()->user() )
                        @if( auth()->user()->id === 5 )
                    <a href="{{ url("post/$post->id/detail") }}" class=""> [ View ] </a>
                    <a href="{{ url("post/$post->id/edit") }}" class=""> [ Edit ] </a>
                    <a href="{{ url("post/$post->id/destroy") }}" class=""> [ Delete ] </a>
                        @endif
                    @endif

                    <img src="{{ asset('upload/' . $post->cover_name) }}" alt="{{ $post->cover_name }}" class="img-fluid">
                    <a class="d-flex justify-content-center align-items-center" href="#">
                        Image details >>>
                    </a>
                    <p class="card-text">{{ $post->body }}</p>
                    
                    <div id="button" class="btn btn-primary">
                        <span class="badge badge-danger" style="font-size: 14px;">
                            {{ count($post->comments) }} 
                        </span>
                        
                        <span class="fas fa-comment" style="font-size: 30px;">Comments</span>
                    </div>
                </div>
            </div>

            <div class="comment p-3 m-0 bg-dark text-dark">
                <div class="card-body">
                    
                
                    <h6 class="card-title">Write Comment...</h6>
                    
                    <ul class="list-group bg-dark">
                        
                        @foreach($post->comments as $comment)

                        <li class="list-group-item bg-dark">
                            <p class="title text-light" style="font-style: italic;font-weight: bold;"> {{ $comment->user_name }}</p>
                        
                            <p class="text text-light">{{ $comment->comment }}</p>
                            @if(auth()->user())
                                @if(auth()->user()->id === $comment->user_id)
                                    <a href="{{ url("post/comment/delete/{$comment->id}") }}" class="" style="list-style-type: none;text-decoration:none;float: right;">[ delete ]</a>
                                @endif
                            @endif
                        </li>
                        

                        @endforeach
                    </ul>

                    @if( auth()->user() )

                    <form action="{{ url("post/comment/create") }}" method="post">
                        @csrf
                        <input type="hidden" name="post_id" id="post_id" class="form-control" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" id="user_id" class="form-control" value="@if (auth()->user()) {{ auth()->user()->id }} @endif">
                        <input type="hidden" name="user_name" id="user_name" class="form-control" value="{{ auth()->user()->name }}">
                       
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <textarea class="form-control bg-dark text-light" name="comment" id="comment" placeholder="Somethings write..."></textarea>
                        </div>
                        <br>
                        <button class="btn btn-warning" type="submit" name="comment_submit" id="comment_submit">Add Comment</button>
                    </form>
                    
                    @endif
                    
                </div>
            </div>

        </div>
    </div>
    
</div>
@endsection






