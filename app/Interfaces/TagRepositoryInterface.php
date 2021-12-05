<?php

namespace App\Interfaces;

use App\Http\Requests\Tag\CreateTagRequest;
use App\Models\Tag;

interface TagRepositoryInterface{
    public function getAllTags();
    public function getPostsbyTag(Tag $tag);
    public function createTag(CreateTagRequest $request);    
}