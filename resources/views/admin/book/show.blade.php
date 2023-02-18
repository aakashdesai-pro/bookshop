@extends('admin.app')
@section('content')
<div class="container my-5">
    <div class="header d-flex justify-content-between my-2">
        <h3 class="text-primary">View Book</h3>
        <div>
            <a href="{{ route('admin.book.index') }}" class="btn btn-outline-secondary">Go Back</a>
        </div>
    </div>

    <form>
        <div class="d-flex justify-content-center">
            @if ($book->from_seeder)
            <img src="{{ $book->image_url}}" style="height: 150px;">
            @else
            <img src="/storage/uploads/{{ asset($book->image_url) }}" style="height: 150px;">
            @endif
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Title</label>
                <input name="title" type="text" class="form-control" placeholder="Title" value="{{ $book->title }}" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>Author</label>
                <input name="author" type="text" class="form-control" placeholder="Author" value="{{ $book->author }}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-6">
                <label>Genre</label>
                <input name="genre" type="text" class="form-control" placeholder="Genre" value="{{ $book->genre }}" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>ISBN</label>
                <input name="isbn" type="text" class="form-control" placeholder="ISBN" value="{{ $book->isbn }}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-6">
                <label>Published</label>
                <input name="published" type="date" class="form-control" value="{{ $book->published }}" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>Publisher</label>
                <input name="publisher" type="text" class="form-control" placeholder="Publisher"
                    value="{{ $book->publisher }}" disabled>
            </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" cols="30" rows="10" class="form-control" disabled>{{ $book->description }}</textarea>
        </div>
    </form>
</div>
@endsection