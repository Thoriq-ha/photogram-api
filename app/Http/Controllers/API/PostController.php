<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;

        $this->middleware('auth:sanctum')->only(['store','update','destroy']);
    }

    public function index()
    {
        $posts = $this->postRepository->getAllPosts();
        return $this->successResponse(
            $posts,
            "Posts data successfully fetched"
        );
    }

    public function show(Post $post){
        $post = $this->postRepository->getPostById($post);

        return $this->successResponse(
            $post,
            "Post with id:{$post->id} successfully fetched"
        );
    }

    public function store(CreatePostRequest $request){
        $createdPost = $this->postRepository->createPost($request);
        return $this->successResponse(
            $createdPost,
            "Post successfully created"
        );
    }

    public function update(UpdatePostRequest $request, Post $post){
        $updatedPost = $this->postRepository->updatePost($request, $post);
        return $this->successResponse(
            $updatedPost,
            "Post with id: {$updatedPost->id} successfully updated"
        );
    }

    public function destroy(DeletePostRequest $request, Post $post){
        $tmp_id = $post->id;

        return $this->successResponse(
            $this->postRepository->deletePost($post),
            "Post with id: {$tmp_id} successfully deleted"
        );
    }
}
