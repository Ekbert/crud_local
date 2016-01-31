<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {

		$posts = \App\Post::orderBy('updated_at', 'desc')->paginate(5); 
    	$data =compact('posts');
    	return view('posts.index', $data);
    }
}
