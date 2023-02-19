<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::paginate(12));
    }

    public function getById($id)
    {
        return BookResource::make(Book::find($id));
    }

    public function searchBook($keyword)
    {
        $books = Book::where('title', "LIKE", '%'.$keyword.'%')
            ->orWhere('author', "LIKE", '%'.$keyword.'%')
            ->orWhere('genre', "LIKE", '%'.$keyword.'%')
            ->orWhere('description', "LIKE", '%'.$keyword.'%')
            ->orWhere('isbn', "LIKE", '%'.$keyword.'%')
            ->orWhere('publisher', "LIKE", '%'.$keyword.'%')
            ->paginate(12);

        return BookResource::collection($books);
    }
}
