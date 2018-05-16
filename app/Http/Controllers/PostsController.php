<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except('index', 'show');

    }


    public function index()
    {
        $filters['month'] = Carbon::now()->month;
        $filters['year'] = Carbon::now()->year;
        $posts = Post::latest()
            ->filter($filters)
            ->get();

        $allPosts = Post::archives();

        return view('posts.index', compact('posts', 'allPosts'));
    }


    public function show(Post $post)
    {

        return view('posts.show', compact('post'));

    }

    public function create()
    {

        return view('posts.create');

    }

    public function store()
    {
        $this->validate(request(), [
           'title' => 'required',
            'body' => 'required'
        ]);


        auth()->user()->publish(
            new Post(request(['title','body']))
        );



        return redirect('/');

    }

}
