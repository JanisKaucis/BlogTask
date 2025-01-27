<?php

namespace App\Http\Controllers\MyBlogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Services\MyBlogsService;
use Illuminate\Support\Facades\Log;

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
        $blogs = auth()->user()->blogs()->paginate(10);

        return view('my-blogs.index', compact('blogs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $categories = Category::all();

        return view('my-blogs.create', compact('categories'));
    }

    /**
     * @param BlogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogRequest $request)
    {
        $blog = $this->service->handleStore($request);

        return redirect()->route('my-blogs.show', ['blog' => $blog]);
    }

    /**
     * @param Blog $blog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Blog $blog)
    {
        $blog->load('categories');
        $categories = Category::all();

        return view('my-blogs.edit', compact('blog', 'categories'));
    }

    /**
     * @param Blog $blog
     * @param BlogUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Blog $blog, BlogUpdateRequest $request)
    {
        $blog = $this->service->handleUpdate($blog, $request);

        return redirect()->route('my-blogs.show', ['blog' => $blog]);
    }

    /**
     * @param Blog $blog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(Blog $blog)
    {
        $categories = Category::pluck('name', 'id');

        return view('my-blogs.show', compact('blog', 'categories'));
    }

    /**
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('my-blogs');
    }
}
