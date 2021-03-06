<?php

namespace Tests\Feature;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{
    
    use RefreshDatabase;
    public function test_an_author_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/author',[
            'name'=>'Author Name',
            'dob'=> Carbon::now()
        ]);
        $author = Author::all();
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob );
    }
}
