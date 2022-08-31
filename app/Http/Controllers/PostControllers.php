<?php

namespace App\Http\Controllers;
use App\Models\Team_member;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostControllers extends Controller
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function team(Request $request)
    {
        # code...
        $this->validate(
            $request,
            [
                'name' => 'required',
                'position' => 'required',
                'image' => 'required'
            ]
        );
        $imagePath = $request->image->store('/uploads', 'public');
    $post=Team_member::create(
            [
                'name' => $request->name,
                'position' => $request->position,
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
    public function update(Request $request,$id)
    {
        //
        $post=posts::find($id);
        $post->update($request->all());
        return $post;

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
