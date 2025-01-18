<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
