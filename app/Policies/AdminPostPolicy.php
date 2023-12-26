<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPostPolicy
{
  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Post $post): bool
  {
    return !in_array($post->author->role, ['admin', 'owner']);
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Post $post): bool
  {
    return !in_array($post->author->role, ['admin', 'owner']);
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Post $post): bool
  {
    return !in_array($post->author->role, ['admin', 'owner']);
  }
}
