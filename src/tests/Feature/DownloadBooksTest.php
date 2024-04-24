<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class DownloadBooksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDownloadBooks()
    {
        $books = factory(Book::class, 3)->create();
        
        $response = $this->get('/download?columns_select=all&format_select=csv');
        $response->assertSuccessful();
        $response->assertHeader('content-disposition', 'attachment; filename=books.csv');

        $response = $this->get('/download?columns_select=title&format_select=xml');
        $response->assertSuccessful();
        $response->assertHeader('content-disposition', 'attachment; filename=books.xml');
    }
}
