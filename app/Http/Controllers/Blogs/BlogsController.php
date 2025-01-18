<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Services\BlogsService;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    private BlogsService $service;

    public function __construct(BlogsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $blogs = Blog::with('categories', 'categories.category')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $categories = Category::pluck('name', 'id');
        $comments = $blog->comments()->with('user')->get();
        return view('blogs.show', compact('blog', 'categories', 'comments'));
    }

    public function category(Category $category)
    {
        $blogs = Blog::whereHas('categories', function ($query) use ($category){
            $query->where('category_id', $category->id);
        })->with('categories', 'categories.category')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $blogs = Blog::where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->get();

        return view('blogs.index', compact('blogs'));
    }
}
