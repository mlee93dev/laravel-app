<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSearchBooks()
    {
        $book = ['title' => 'foo', 'author' => 'bar'];
        $books = factory(Book::class)->create($book);

        $response = $this->get('/search?search=foo');
        $response->assertSuccessful();
        $response->assertViewIs('books');
        $response->assertViewHas(['books' => $books->get()]);
    }
}
