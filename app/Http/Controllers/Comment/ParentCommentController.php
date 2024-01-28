<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class ParentCommentController extends Controller
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
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->orderBy(
                    $request->get('sort', $request->get('sort')),
                    $request->get('direction', $request->get('direction'))
                );
        } else {
            $q->orderBy(
                $request->get('sort', $request->get('sort', 'created_at')),
                $request->get('direction', $request->get('direction', 'desc'))
            );
        }

        $parentComments = $q->paginate($request->get('perPage', 25));

        return [
            'comments' => CommentResource::collection($parentComments),
            'total' => $parentComments->total(),
            'currentPage' => $parentComments->currentPage(),
            'perPage' => $parentComments->perPage(),
        ];
    }
}
