<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class DeleteBookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDeleteBook()
    {
      $book = factory(Book::class)->create();
      $id = $book->get()->first()->id;
        
      $response = $this->delete('/book/'.$id);
      $response->assertStatus(302);
      $this->assertDeleted('books', ['id' => $book]);
    }
}
