<?php
namespace App\Repositories;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentRepository implements CommentRepositoryInterface{

    public function getAllPostComments(Post $post)
    {
        $comments = Post::find($post->id)->comments()->get();
        return $comments;
    }

    public function createComment(CreateCommentRequest $request, Post $post)
    {        
        $comment = $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        return $comment;
    }

    public function deleteComment(Comment $comment)
    {
        Comment::destroy($comment->id);
    }
}