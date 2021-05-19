<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;

class Authorcontroller extends Controller
{
    public function store(Request $request){
        Author::create(request()->only(['name','dob']));
    }
}
