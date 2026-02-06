<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use function Pest\Laravel\post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
       $post = Post::create($validated);
        return ['post'=>$post];
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return [$post];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post->update($validate);

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // no need to give the id (since we will get it from the url. (unsafe)).
        $post->delete();
        // message for displaying what title is removed;
        $message = $post->title . ": is gone";

        return ['message' =>  $message];
    }

