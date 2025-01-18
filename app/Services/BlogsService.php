<?php
namespace App\Services;

class BlogsService
{
    public function handleComment($blog, $request)
    {
        $requestData = $request->all();
        $requestData['user_id'] = auth()->user()->id;
        $blog->comments()->create($requestData);
    }
}
