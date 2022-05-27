@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">
                <h4 class="text-center">Add New Post</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="expection">Expection</label>
                        <input type="text" name="exception" value="{{ old('exception') }}" class="form-control">
                    </div>
                    <div class="fomr-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="" value="{{ old('body') }}" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" name="cover" value="{{ old('cover') }}" class="form-control">
                    </div>
                    <input type="submit" name="submit" value="Upload Post" class="btn btn-success">
                    <a href="{{ route('post.index') }}" class="btn btn-dark">Back <<</a>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
