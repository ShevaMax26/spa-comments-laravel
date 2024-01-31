<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->paragraph(rand(1, 5)),
            'user_id' => User::factory(),
            'question_id' => Question::factory(),
            'parent_id' => null,
            'created_at' => now()
                ->subDays(rand(1, 30))
                ->subMinutes(rand(1, 60)),
        ];
    }
}
