@extends('admin.app')
@section('content')
<div class="m-5">
    <div class="header d-flex justify-content-between my-2">
        <h3 class="text-primary">All Books</h3>
        <a href="{{ route('admin.book.create') }}" class="btn btn-outline-primary">Add Book</a>
    </div>
    <table class="table table-striped table-bordered commonTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Description</th>
                <th>ISBN</th>
                <th>Published</th>
                <th>Publisher</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->id}}</td>
                <td>
                    @if ($book->from_seeder)
                    <img src="{{ $book->image_url}}" style="height: 30px; width:30px">
                    @else
                    <img src="/storage/uploads/{{ asset($book->image_url) }}" style="height: 30px; width:30px">
                    @endif
                </td>
                <td>{{ $book->title}}</td>
                <td>{{ $book->author}}</td>
                <td>{{ $book->genre}}</td>
                <td> {{ Str::limit($book->description, 10)}}</td>
                <td>{{ $book->isbn}}</td>
                <td>{{ $book->published}}</td>
                <td>{{ $book->publisher }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('admin.book.show', $book->id) }}" class="btn btn-sm btn-success mx-2">View</a>
                        <a href="{{ route('admin.book.edit', $book->id) }}" class="btn btn-sm btn-warning mx-2">Edit</a>
                        <form action="{{ route('admin.book.destroy', $book->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-sm btn-danger mx-2" onclick=" return confirm('Are you sure you want to delete?')">
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Description</th>
                <th>ISBN</th>
                <th>Published</th>
                <th>Publisher</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection