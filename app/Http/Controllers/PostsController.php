<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class  PostsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{
		$posts = \App\Post::orderBy('updated_at', 'desc')->paginate(5); 
		$data =compact('posts');
		return view('posts.index', $data);
	}



	public function hot()
	{
		$posts = \App\Post::where('page_view', '>', '100')->orderBy('id', 'desc')->paginate(5); /* 略 */
		$data =compact('posts');
		return view('posts.index', $data);
	}



	public function random()
	{
		$post = \App\Post::find(rand(1, 20)); /* 略 */
		$data =compact('post');
		return view('posts.show', $data);
	}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
	{
		$post = \App\Post::find($id); /* 略 */

		if(is_null($post))
		{
			// abort(404);

			return redirect()->route('posts.index')->with('message','Article Not Found!!');
		}
		// $data = [

		// 	'posts' = $posts;
		// ]

		$data =compact('post');
		return view('posts.show', $data);
	}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create()
	{
	    return view('posts.create');
	}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function edit($id) 
	{

		$post = \App\Post::find($id); /* 略 */
	    $data = compact('post');
	    return  view('posts.edit', $data);
	}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	// 新增文章：posts/create 後的 store 進資料庫，
	public function store(PostRequest $request) 
	{
		// 只要能夠執行到這一行就表示通過 [App\Http\Requests] PostRequest 驗證了

		$post = \App\Post::create($request->except('_token'));
	    return redirect()->route('posts.show', $post->id); //redirect()：可以自動跳轉到指定的頁面
	}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(PostRequest $request, $id)
	{
		$post = \App\Post::find($id);
		$post -> update($request -> except('_token'));
		return redirect()->route('posts.show', $id);
	}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy($id) 
	{
		\App\Post::destroy($id);
	    return redirect()->route('posts.index');
	}



	public function comment() 
	{
	    return 'posts.comment: '.$id;
	}


}
