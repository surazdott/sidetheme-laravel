<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name', 'slug', 'content', 'meta_title', 'meta_description', 'status'];
}
