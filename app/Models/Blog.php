<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Blog extends Model
{
    protected $guarded = [];
    protected $casts = [
        'description' => CleanHtml::class, // cleans both when getting and setting the value
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->hasMany(BlogCategory::class);
    }
}
