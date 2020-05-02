<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = ['name', 'slug', 'parent_id', 'order_id', 'meta_title', 'meta_description'];

	// Child  has many Parent Category
	public function children()
	{
    return $this->hasMany('App\Category', 'parent_id', 'id');
  }

  // Child belogs to Parent Category
  public function parent()
  {
      return $this->belongsTo('App\Category', 'parent_id');
  }

  // Category has many items
  public function items()
  {
    return $this->hasMany('App\Item')->orderBy('id', 'desc');
  }

  // Items by Parent Category
  public function itemsByParent() {
    return $this->hasManyThrough(Item::class, Category::class, 'parent_id', 'category_id', 'id')->orderBy('id', 'desc');
  }

}
