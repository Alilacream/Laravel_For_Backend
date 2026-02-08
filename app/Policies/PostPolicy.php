<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     *NOTE: Determines if the user's id is equals to the post user_id, if yes this user  HAS that post.
     * Meaning he is allowed to do whatever he wants with his post.
     */
   public function modify(User $user, Post $post): Response
    {
        return $user->id == $post->user_id ? Response::allow() : Response::denyWithStatus(401, "You do not own this post.");
    }
}
