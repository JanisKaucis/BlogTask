<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MyBlogsService
{
    /**
     * @param $request
     * @return mixed
     */
    public function handleStore($request)
    {
        $requestData = $request->safe()->except('image', 'categories');
        $path = Storage::disk('public')->put('blogs/images/'.auth()->user()->id, $request->file('image'));
        $requestData['image'] = $path;
        $blog = auth()->user()->blogs()->create($requestData);
        $blog->categories()->sync($request->categories);

        return $blog;
    }

    /**
     * @param $blog
     * @param $request
     * @return mixed
     */
    public function handleUpdate($blog, $request)
    {
        $requestData = $request->safe()->except('_token', 'image', 'categories');
        if ($request->image) {
            Storage::disk('public')->delete($blog->image);
            $path = Storage::disk('public')->put('blogs/images/'.auth()->user()->id, $request->file('image'));
            $requestData['image'] = $path;
        }
        $blog->update($requestData);
        $blog->categories()->sync($request->categories);

        return $blog;
    }
}
