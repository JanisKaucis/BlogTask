<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MyBlogsService
{
    public function handleStore($request)
    {
        $requestData = $request->except('image', 'categories');
        $path = Storage::disk('public')->put('blogs/images/'.auth()->user()->id, $request->file('image'));
        $requestData['image'] = $path;
        $blog = auth()->user()->blogs()->create($requestData);
        foreach ($request->categories as $category) {
            $blog->categories()->create([
                'category_id' => $category
            ]);
        }

        return $blog;
    }
    public function handleUpdate($blog, $request)
    {
        $requestData = $request->except('_token', 'image', 'categories');
        Storage::disk('public')->delete($blog->image);
        $path = Storage::disk('public')->put('blogs/images/'.auth()->user()->id, $request->file('image'));
        $requestData['image'] = $path;
        $blog->update($requestData);
        foreach ($request->categories as $category) {
            $blog->categories()->update([
                'category_id' => $category
            ]);
        }

        return $blog;
    }
}
