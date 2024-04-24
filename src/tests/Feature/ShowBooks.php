<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowBooks extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomepageShouldRetrieveAllBooks()
    {
        //Given any user
        //When they access the homepage
        
        $response = $this->get('/');

        //Then there should be a list of all books
        $response->assertStatus(200);


    }
}
