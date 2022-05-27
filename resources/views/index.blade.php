@extends('layouts.app')

@section('content')
<div class="container">
  
    <style>
        body, #card-row, #card{
            background-color: lightgray !important;
        }
        #card{
            color: black !important; 
        }
    </style>
    
    @if(session('status'))
        <div class="alert alert-success data-bs-dismiss fade show success()" id="success">{{ session('status') }} </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif


    <div class="row mb-1 bg-dark" id="card-row">
        @foreach($posts as $post)
        <div class="col-md-3">
            <div class="card bg-dark text-light" id="card" style="margin:none; border:none;">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <small class="">{{ $post->created_at->diffForHumans() }}</small>
                    <a href="{{ url("post/$post->id/detail") }}">
                        <img src="{{ asset('upload/' . $post->cover_name) }}" alt="{{ $post->cover_name }}" class="img-fluid">
                    </a>
                    <p class="card-text">
                        {{ $post->exception }}
                        <a href="{{ url("post/$post->id/detail")}}" class="">See more...</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach

      
    </div>

    {{ $posts->links() }}
    
</div>
@endsection










