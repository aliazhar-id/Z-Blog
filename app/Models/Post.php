<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
  use HasFactory;

  protected $guarded = ['id_post'];
  protected $with = ['category', 'author'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'id_user');
  }

  public function getRouteKeyName()
  {
    return 'slug';
  }
}
