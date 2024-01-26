<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class ParentCommentController extends Controller
{
    public function index()
    {
        $parentComments = Comment::whereNull('parent_id')->with('user')->paginate(25);

        return CommentResource::collection($parentComments);
    }
}
