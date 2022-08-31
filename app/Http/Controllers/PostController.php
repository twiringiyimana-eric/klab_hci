<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = Post::all();
        return response()->json([
            'message' => 'success',
            'posts' => $post
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # code...
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required',
                'image' => 'required'
            ]
        );
        $imagePath = $request->image->store('/uploads', 'public');
        $post = $request->user()->posts()->create(
            [
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath
            ]
        );

        return response()->json([
            'message' => 'success',
            'post' => $post
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Posts($id)
    {
        $post = Post::findOrFail($id);
        return response()->json([
            'message' => 'success',
            'post' => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
   
        $post = Post::make($input, [
            'title' => 'required',
            'content' => 'required'
        ]);
   
       if($post->fail()){
            return $this->sendError('Post Error.', $post->errors());       
        }
   
        $post->name = $input['title'];
        $post->content = $input['content'];
        $post->save();
   
        return response()->json([
            "success" => true,
            "message" => "Post updated successfully.",
            "data" => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            'message' => 'success',
            'post' => $post
        ], 200);
        return response()->json([
            'message' => 'success',
            'post' => $post
        ], 200);
    }
}
