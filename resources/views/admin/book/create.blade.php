@extends('admin.app')
@section('content')
<div class="container my-5">
    <div class="header d-flex justify-content-between my-2">
        <h3 class="text-primary">Add Book</h3>
        <div>
            <a href="{{ route('admin.book.index') }}" class="btn btn-outline-secondary">Go Back</a>
            <label for="submitBtn" class="btn btn-primary">Save Book</label>
        </div>
    </div>

    <form action="{{ route('admin.book.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="row">
            <div class="form-group col-md-6">
                <label>Image</label>
                <input name="image" type="file" class="form-control">
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') }}">
                @error('title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-6">
                <label>Author</label>
                <input name="author" type="text" class="form-control" placeholder="Author" value="{{ old('author') }}">
                @error('author')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>Genre</label>
                <input name="genre" type="text" class="form-control" placeholder="Genre" value="{{ old('genre') }}">
                @error('genre')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-4">
                <label>ISBN</label>
                <input name="isbn" type="text" class="form-control" placeholder="ISBN" value="{{ old('isbn') }}">
                @error('isbn')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>Published</label>
                <input name="published" type="date" class="form-control" value="{{ old('published') }}">
                @error('published')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>Publisher</label>
                <input name="publisher" type="text" class="form-control" placeholder="Publisher" value="{{ old('publisher') }}">
                @error('publisher')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
            @error('description')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <input type="submit" id="submitBtn" class="d-none">
    </form>
</div>
@endsection