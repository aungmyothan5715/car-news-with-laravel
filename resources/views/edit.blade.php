@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">
                <h4 class="text-center">Edit Post</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form action="{{ url("post/$post->id/update") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="expection">Expection</label>
                        <input type="text" name="exception" value="{{ $post->exception }}" class="form-control">
                    </div>
                    <div class="fomr-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="" class="form-control"> {{ $post->body }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" name="cover" value="{{ $post->cover_name }}" class="form-control">
                    </div>
                    <input type="submit" name="submit" value="Update Post" class="btn btn-success">
                    <a href="{{ route('post.index') }}" class="btn btn-dark">Back <<</a>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
