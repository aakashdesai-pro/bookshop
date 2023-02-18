<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.book.index')->with(compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'file'],
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'genre' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'isbn' => ['required', 'max:255'],
            'published' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
        ]);

        $image = $request->file('image');
        $newImageName = Str::random(20).time().".".$image->getClientOriginalExtension();
        $image->storeAs('uploads', $newImageName, 'public');

        Book::create([
            'image_url' => $newImageName,
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'published' => $request->published,
            'publisher' => $request->publisher,
            'from_seeder' => false
        ]);
        
        return redirect()->route('admin.book.index')->with('alert','Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        return view('admin.book.show')->with(compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        return view('admin.book.edit')->with(compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'file', 'mimetypes:image/*'],
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'genre' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'isbn' => ['required', 'max:255'],
            'published' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
        ]);
        
        
        $book = Book::find($id);
        
        if ($request->hasFile('image')) {
            if (!$book->from_seeder) {
                $oldImage = public_path('/storage/uploads/'.$book->image_url);
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $image = $request->file('image');
            $newImageName = Str::random(20).time().".".$image->getClientOriginalExtension();
            $image->storeAs('uploads', $newImageName, 'public');
            $book->image_url = $newImageName;
            $book->from_seeder = false;
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->description = $request->description;
        $book->isbn = $request->isbn;
        $book->published = $request->published;
        $book->publisher = $request->publisher;
        $book->save();
        
        return redirect()->route('admin.book.index')->with('alert','Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::find($id)->delete();
        return back()->with('alert', 'Book deleted successfully');
    }
}
