<?php

namespace App\Interfaces;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;

interface CommentRepositoryInterface{
    public function getAllPostComments(Post $post);
    public function createComment(CreateCommentRequest $request, Post $post);
    public function deleteComment(Comment $comment);
}