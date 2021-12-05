<?php

namespace App\Interfaces;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;

interface PostRepositoryInterface{
    public function getAllPosts();
    public function getPostById(Post $post);
    public function createPost(CreatePostRequest $request);
    public function updatePost(UpdatePostRequest $request, Post $post);
    public function deletePost(Post $post);
}