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
                'firstname' => 'required',
                'lastname' => 'required',
                'position' => 'required',
                'image' => 'required',
                'twitter' => 'required',
                'background' => 'required',
                'type' => 'required'
            ]
        );
            $file =cloudinary()->uploadFile($request->file('image')->getRealPath())->getSecurePath();
            $post=Team_member::create(
            [
                
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'position' => $request->position,
                'image' =>  $file,
                'twitter' => $request->twitter,
                'background' => $request->background,
                'type' => $request->type,
                'user_id'=>auth()->user()->id
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
    public function viewPosts()
    {
        $post = Post::all();
        return response()->json([
            'message' => 'success',
            'post' => $post
        ], 200);
    }
    public function viewTeams()
    {
        $teams = Team_member::all();
        return response()->json([
            'message' => 'success',
            'post' => $teams
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Team_member $id,request $request)
    {
        
        
          $id->update($request->all());
         return response(['results'=>$id],200);
        
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
    public function deleteTeam($id)
    {
        //
        $post = Team_member::findOrFail($id);
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
