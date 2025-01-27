<?php
namespace App\Http\Controllers\Blogs;

use App\Http\Requests\BlogCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Services\BlogsService;

class BlogCommentsController
{
    /**
     * @param Blog $blog
     * @param BlogCommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Blog $blog, BlogCommentRequest $request)
    {
        $requestData = $request->validated();
        $requestData['user_id'] = auth()->user()->id;
        $blog->comments()->create($requestData);

        return back();
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
