<?php

namespace App\Http\Controllers\Question;

use App\Actions\CreateQuestion;
use App\Http\Controllers\Controller;
use App\Http\Requests\Question\StoreRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $q = Question::query()
            ->with('user');

        if (in_array($request->get('sort'), ['name', 'email'])) {
            $q->select(
                'questions.*',
                'users.name',
                'users.email',
            )
                ->join('users', 'users.id', '=', 'questions.user_id');
        }

        $q->orderBy(
            $request->get('sort', $request->get('sort', 'created_at')),
            $request->get('direction', $request->get('direction', 'desc'))
        );

        $questions = $q->paginate($request->get('perPage', 25));

        return [
            'questions' => QuestionResource::collection($questions),
            'total' => $questions->total(),
            'currentPage' => $questions->currentPage(),
            'perPage' => $questions->perPage(),
        ];
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Question::class);
        return QuestionResource::make(app(CreateQuestion::class)->handle(
            $request->validated(),
            auth()->user()));
    }

    public function show(Question $question)
    {
        return QuestionResource::make(
            $question
                ->load([
                    'parentComments',
                    'user'
                ])
                ->loadCount('comments')
        );
    }
}
