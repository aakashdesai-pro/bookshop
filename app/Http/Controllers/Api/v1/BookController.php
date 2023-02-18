<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::paginate(10));
    }

    public function getById($id)
    {
        return BookResource::make(Book::find($id));
    }
}
