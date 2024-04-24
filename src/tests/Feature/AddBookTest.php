<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
        $book = [
          'title' => 'foo',
          'author' => 'bar'
        ];
        
        $this->post('/book', $book);

        $this->assertDatabaseHas('books', $book);
    }
}
