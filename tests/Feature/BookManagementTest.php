<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
   public function test_a_book_can_be_added_to_the_library(){

    $response = $this->post('/books',[
        'title'=>'Cool book titile',
        'author'=> 'Doe'
    ]);
  
   $book = Book::first();
   
   $response->assertRedirect('/books/'.$book->id);    

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
    
     $this->post('/books',[
        'title'=>'Cool book titile',
        'author'=> 'Doe'
    ]);

    $book = Book::first();
    $response = $this->patch('/books/'.$book->id,[
        'title'=> 'New title',
        'author'=> 'New Author'
    ]);

    $this->assertEquals('New title', Book::first()->title);
    $this->assertEquals('New Author', Book::first()->author);
        $response->assertRedirect('/books/'.$book->id);
   }

   public function test_a_book_can_be_deleted(){
    
    $this->post('/books',[
        'title'=>'Cool book titile',
        'author'=> 'Doe'
    ]);

    $book = Book::first();
    $response = $this->delete('/books/'.$book->id);

    $this->assertCount(0, Book::all());
    $response->assertRedirect('/books');
   }
}
