<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
   public function test_a_book_can_be_added_to_the_library(){

    $this->withoutExceptionHandling();

    $response = $this->post('/books',[
        'title'=>'Cool book titile',
        'author'=> 'Doe'
    ]);
   $response->assertOk();
   $this->assertCount(1, Book::all());     

   }
   public function test_a_title_is_required(){
    

    $response = $this->post('/books',[
        'title'=>'',
        'author'=> 'Doe'
    ]); 
    $response->assertSessionHasErrors('title');
   }
   public function test_a_author_is_required(){
    

    $response = $this->post('/books',[
        'title'=>'Cool title',
        'author'=> ''
    ]); 
    $response->assertSessionHasErrors('author');
   }

   public function test_a_book_can_be_updated(){
    $this->withoutExceptionHandling();

     $this->post('/books',[
        'title'=>'Cool book titile',
        'author'=> 'Doe'
    ]);

    $book = Book::first();
    $this->patch('/books/'.$book->id,[
        'title'=> 'New title',
        'author'=> 'New Author'
    ]);

    $this->assertEquals('New title', Book::first()->title);
    $this->assertEquals('New Author', Book::first()->author);

   }
}
