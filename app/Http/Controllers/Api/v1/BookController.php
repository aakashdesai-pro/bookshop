<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    public function index()
    {
        $books = QueryBuilder::for(Book::class)
            ->allowedFilters(['title', 'author', 'genre', 'description', 'isbn', 'published', 'publisher'])
            ->paginate(8);
        return BookResource::collection($books);
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
            ->paginate(8);

        return BookResource::collection($books);
    }
}
