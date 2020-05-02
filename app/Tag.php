<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug', 'meta_title', 'meta_description'];

    public function items(){
        return $this->belongsToMany('App\Item');
    }
}
