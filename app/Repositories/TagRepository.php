<?php

namespace App\Repositories;

use App\Http\Requests\Tag\CreateTagRequest;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface{

    public function getAllTags()
    {
        return Tag::with(['posts'])->get();
    }

    public function getPostsbyTag(Tag $tag)
    {
        return Tag::find($tag->id)->posts()->get();
    }

    public function createTag(CreateTagRequest $request)
    {
        $tag = Tag::create($request->all());

        return $tag;
    }
}