<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Http\Requests\PostRequest;
use App\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        $prefectures = Prefecture::all();
        return view('posts.index', [
            'posts' => $posts,
            'prefectures' => $prefectures,
        ]);
    }

    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function create()
    {
        $prefectures = Prefecture::all();
        $all_tag_names = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('posts.create', [
            'all_tag_names' => $all_tag_names,
            'prefectures' => $prefectures,
        ]);
    }

    public function store(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->user_id = $request->user()->id;
        $post->prefecture_id = $request->prefecture_id;
        $post->save();

        $request->tags->each(function ($tag_name) use ($post) {
            $tag = Tag::firstOrCreate(['name' => $tag_name]);
            $post->tags()->attach($tag);
        });

        return redirect()->route('home');
    }

    public function edit(Post $post)
    {
        $prefectures = Prefecture::all();
        $tag_names = $post->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $all_tag_names = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        
        return view('posts.edit', [
            'post' => $post,
            'tag_names' => $tag_names,
            'all_tag_names' => $all_tag_names,
            'prefectures' => $prefectures,
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->prefecture_id = $request->prefecture_id;
        $post->save();

        $post->tags()->detach();
        $request->tags->each(function ($tag_name) use ($post) {
            $tag = Tag::firstOrCreate(['name' => $tag_name]);
            $post->tags()->attach($tag);
        });
        return redirect()->route('post.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('home');
    }
}