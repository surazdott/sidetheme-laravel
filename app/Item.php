<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes;

    protected $fillable = ['name', 'slug', 'short_description', 'description', 'image', 'file', 'download_link', 'category_id', 'compatible', 'author', 'released', 'version', 'framework', 'files_included', 'file_size', 'documentation', 'compatible_browser', 'download', 'live_demo', 'meta_title', 'meta_description', 'status'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
