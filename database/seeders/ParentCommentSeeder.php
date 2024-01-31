<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::all()->map(function (Question $question) {
            Comment::factory([
                'question_id' => $question->id
            ])
                ->count(rand(0,20))
                ->create();
        });
    }
}
