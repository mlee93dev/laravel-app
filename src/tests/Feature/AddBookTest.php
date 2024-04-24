<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class AddBook extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddBook()
    {
        $book = factory(Book::class)->make()->toArray();
        
        $this->post('/book', $book);

        $this->assertDatabaseHas('books', $book);
    }
}
