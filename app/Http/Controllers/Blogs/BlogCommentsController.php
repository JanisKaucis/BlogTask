<?php
namespace App\Http\Controllers\Blogs;

use App\Http\Requests\BlogCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Services\BlogsService;

class BlogCommentsController
{
    public function __construct(BlogsService $service)
    {
        $this->service = $service;
    }
    public function store(Blog $blog, BlogCommentRequest $request)
    {
        $this->service->handleComment($blog, $request);
        return back();
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
