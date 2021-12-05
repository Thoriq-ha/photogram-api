<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagController extends Controller
{

    private TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository )
    {
        $this->tagRepository = $tagRepository;        
    }    

    public function index(){
        $tags = $this->tagRepository->getAllTags();

        return $this->successResponse(
            $tags,
            "Tags list successfully fetched"
        );
    }

    public function show(Tag $tag){
        $posts = $this->tagRepository->getPostsbyTag($tag);

        return $this->successResponse(
            $posts,
            "Post with tag: {$tag->name} successfully fetched"
        );
    }

    public function store(CreateTagRequest $request){
        $tag = $this->tagRepository->createTag($request);

        return $this->successResponse(
            $tag,
            "Tag successfully created"
        );
    }
}
