<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Http\Requests\PostRequest;
use App\Prefecture;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index(Request $request)
    {
        $search_title = $request->input('title');
        $search_prefecture = $request->input('prefecture_id');
        $prefectures = Prefecture::all();
 
        $query = Post::query();
 
        if (!empty($search_title)) {
            $query->where('title', 'LIKE', "%{$search_title}%");
        }

        if (!empty($search_prefecture)) {
            $query->where('prefecture_id', $search_prefecture);
        }
 
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('posts.index', [
            'posts' => $posts,
            'prefectures' => $prefectures,
            'search_title' => $search_title,
            'search_prefecture' => $search_prefecture,
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

    public function create(Post $post)
    {
        $prefectures = Prefecture::all();
        $all_tag_names = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('posts.create', [
            'all_tag_names' => $all_tag_names,
            'prefectures' => $prefectures,
            'post' => $post,
        ]);
    }

    public function store(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->user_id = $request->user()->id;
        $post->prefecture_id = $request->prefecture_id;

        if(!is_null($request['image'])){
            $file_path = $request->file('image')->store('public/images');
            $post->image = basename($file_path);
        }
        
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

        if(!is_null($request['image'])){
            $file_path = $request->file('image')->store('public/images');
            $post->image = basename($file_path);
        }
        
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

    public function region_show(string $name)
    {
        $posts = Post::all();
        $region = Region::where('name', $name)->first();
        Log::debug($region);

        foreach($posts as $post) {
            Log::debug($post->prefecture->region->name);;
        }

        return view('posts.region', [
            'posts' => $posts,
            'region' => $region,
        ]);
    }
}