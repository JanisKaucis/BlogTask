<?php

namespace App\Http\Controllers\MyBlogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Services\MyBlogsService;

class MyBlogsController extends Controller
{
    private MyBlogsService $service;

    /**
     * @param MyBlogsService $service
     */
    public function __construct(MyBlogsService $service)
    {
        $this->service = $service;
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $blogs = auth()->user()->blogs;

        return view('myBlogs.index', compact('blogs'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('myBlogs.create', compact('categories'));
    }
    public function store(BlogRequest $request)
    {
        $blog = $this->service->handleStore($request);
        return redirect()->route('my-blogs.show', ['blog' => $blog]);
    }
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        $selectedCategories = $blog->categories()->pluck('category_id')->toArray();

        return view('myBlogs.edit', compact('blog', 'categories', 'selectedCategories'));
    }
    public function update(Blog $blog, BlogRequest $request)
    {
        $blog = $this->service->handleUpdate($blog, $request);
        return redirect()->route('my-blogs.show', ['blog' => $blog]);
    }
    public function show(Blog $blog)
    {
        $categories = Category::pluck('name', 'id');
        return view('myBlogs.show', compact('blog', 'categories'));
    }
    public function destroy()
    {

    }
}
