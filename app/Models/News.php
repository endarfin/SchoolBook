<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable =['id', 'categories_id', 'user_id', 'img', 'slug', 'title', 'excerpt', 'content',
        'is_published', 'published_ad', 'created_at', 'updated_at', 'deleted_at'];

    protected $table = 'news';

    public function author()
    {
        return $this->belongsTo(User::Class, 'user_id');
    }
    public function categories()
    {
        return $this->belongsTo(NewsCategories::Class, 'categories_id');
    }
}
