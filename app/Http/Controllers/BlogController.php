<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::all();
    }

    public function store(Request $request)
    {
        $path = $request->file('image') ? $request->file('image')->store('public/blog_images') : null;
        $blog = Blog::create(
            array_merge(
                $request->all(),
                [
                    'slug' => \Str::slug($request->name, '-'),
                    'image' => env('APP_URL') . '/storage/' . str_replace('public/', '' ,$path)
                ]
            )
        );

        return $blog;
    }

    public function show(Blog $blog)
    {
        return $blog;
    }

    public function update(Request $request, Blog $blog)
    {
        $path = $request->file('image') ? $request->file('image')->store('public/blog_images') : null;

        $blog->fill($request->all());
        $blog->fill([
            'slug' => \Str::slug($request->name, '-'),
            'image' => env('APP_URL') . '/storage/' . str_replace('public/', '' ,$path)
        ]);
        $blog->save();
        $blog->fresh();

        return $blog;
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return 'Blog deleted successfully';
    }
}
