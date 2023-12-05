<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
  use HasFactory, Sluggable;

  protected $guarded = ['id_post'];
  protected $primaryKey = 'id_post';
  protected $with = ['category', 'author'];

  public function category()
  {
    return $this->belongsTo(Category::class, 'id_category');
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'id_user');
  }

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function scopeFilter($query, array $filters)
  {
    if ($filters['search'] ?? false) {
      $query->when($filters['search'] ?? false, function ($query, $search) {
        return $query->where(function ($query) use ($search) {
          $query->where('title', 'like', "%$search%");
        });
      });

      $query->when(isset($filters['body']) ? $filters['search'] : false, function ($query, $search) {
        return $query->orWhere(function ($query) use ($search) {
          $query->where('body', 'like', "%$search%");
        });
      });
    }
  }

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }
}
