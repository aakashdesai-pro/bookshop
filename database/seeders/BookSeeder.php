<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fakerapi.it/api/v1/books?_quantity=100');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        foreach (json_decode($result)->data as $book) {
            Book::create([
                'image_url' => $book->image,
                'title' => $book->title,
                'author' => $book->author,
                'genre' => $book->genre,
                'description' => $book->description,
                'isbn' => $book->isbn,
                'published' => $book->published,
                'publisher' => $book->publisher,
                'from_seeder' => true
            ]);
        }
    }
}
