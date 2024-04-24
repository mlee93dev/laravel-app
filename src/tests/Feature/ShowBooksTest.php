<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class ShowBooks extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomepageShouldShowBooks()
    {
        $books = factory(Book::class)->create();

        $response = $this->get('/');
        $response->assertSuccessful();
        $response->assertViewIs('books');
        $response->assertViewHas(['books' => $books->get()]);
      }
}
