<?php

namespace App\Http\Controllers\Comment;

use App\Actions\CreateComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $q = Comment::query()
            ->whereNull('parent_id')
            ->with('user');

        if (in_array($request->get('sort'), ['name', 'email'])) {
            $q->select(
                'comments.*',
                'users.name',
                'users.email',
            )
                ->join('users', 'users.id', '=', 'comments.user_id');
        }

        $q->orderBy(
            $request->get('sort', $request->get('sort', 'created_at')),
            $request->get('direction', $request->get('direction', 'desc'))
        );

        $parentComments = $q->paginate($request->get('perPage', 25));

        return [
            'comments' => CommentResource::collection($parentComments),
            'total' => $parentComments->total(),
            'currentPage' => $parentComments->currentPage(),
            'perPage' => $parentComments->perPage(),
        ];
    }

    public function store(StoreRequest $request)
    {
        return CommentResource::make(app(CreateComment::class)->handle(
            $request->validated(),
            auth('sanctum')->user()));
    }

    public function answers(Comment $comment)
    {
        return CommentResource::collection($comment->children);
    }

    public function show(Comment $comment)
    {
        return CommentResource::make(
            $comment
                ->load([
                    'children' => fn($q) => $q->withCount('children'),
                    'user'
                ])
        );
    }
}
