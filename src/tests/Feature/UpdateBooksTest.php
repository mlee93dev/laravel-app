<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class UpdateBooksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdateBooks()
    {
        $book = factory(Book::class, 2)->create(['title' => 'foo', 'author' => 'bar']);
        $id = $book->all()[0]->id;

        $response = $this->patch('/book/'.$id.'?author_input_'.$id.'=test');
        $response->assertStatus(302);
        $this->assertDatabaseHas('books', ['title' => 'foo', 'author' => 'test']);
    }
}
