<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\DeleteCommentRequest;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;

        $this->middleware('auth:sanctum')->except('index');
    }

    public function index(Post $post)
    {

        $comments = $this->commentRepository->getAllPostComments($post);
        return $this->successResponse(
            $comments,
            "Comments from post with id: {$post->id} successfully fetched"
        );
    }

    public function store(CreateCommentRequest $request, Post $post)
    {

        $comment = $this->commentRepository->createComment($request, $post);

        return $this->successResponse($comment, "Comment for post with id: {$post->id} successfully created");
    }

    public function destroy(DeleteCommentRequest $request,Post $post, Comment $comment)
    {
        $tmp_id = $comment->id;

        return $this->successResponse(
            $this->commentRepository->deleteComment($comment),
            "Comment with id {$tmp_id} successfully deleted"
        );
    }
}
