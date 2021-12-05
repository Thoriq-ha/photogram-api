<?php

namespace App\Repositories;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostRepository implements PostRepositoryInterface
{

    public function getAllPosts()
    {
        return Post::with(['user','comments'])->get();
    }

    public function getPostById(Post $post)
    {
        return Post::with(['user','comments'])->findOrFail($post->id);
    }

    public function createPost(CreatePostRequest $request)
    {
        $user = User::find(auth()->id());
        $post = $user->posts()->create($request->all());

        // picture
        $picture = $request->file('picture');
        $picture_uploaded_path = $picture->store('images','public');

        $uploadedPictureResponse = array(
            "picture_name" => basename($picture_uploaded_path),            
            "picture_url" => Storage::disk('public')->url($picture_uploaded_path),
            "mime" => $picture->getClientMimeType()
        );

        $post->picture = $uploadedPictureResponse['picture_name'];

        // tag
        if (!empty($request->tags)) {
            $post->tags()->sync($request->tags);
        }

        $post->save();
        return Post::with('tags')->whereId($post->id)->get();
    }

    public function updatePost(UpdatePostRequest $request, Post $post)
    {
        Post::whereId($post->id)->update($request->all());
        return Post::whereId($post->id)->first();
    }

    public function deletePost(Post $post)
    {
        Post::destroy($post->id);
    }
}
