<?php
namespace App\Services;

use App\Category;
use App\Question;
use Illuminate\Support\Facades\Auth;

class QuestionService
{
    public function questionInCategory($category)
    {
        return Question::whereHas('category', function ($q) use ($category) {
            $q->where('name_en', $category);
        })->get();
    }

    public function create($request)
    {
        if (substr(trim($request->title), -1) == '?') {
            $new_title = trim($request->title);
        } else {
            $new_title = trim($request->title) . '?';
        }
        $question = new Question;
        if (isset($request->anonymous)) {
            $question->anonymous = $request->anonymous;
        }
        $question->title = $new_title;
        $question->body = $request->body;
        $question->user_id = Auth::id();
        $question->save();
        foreach ($request->category as $cat) {
            $category = Category::findOrFail($cat);
            $question->category()->attach($category);
        }
    }

    public function relatedQuestion($question_id)
    {
        $question = Question::findOrFail($question_id);
        $questionCategory = $question->category[0]->name_en;
        return Question::whereHas('category', function ($q) use ($questionCategory) {
            $q->where('name_en', $questionCategory);
        })
            ->where('id', '!=', $question_id)
            ->take(5)
            ->inRandomOrder()
            ->get();
    }

    public function getAllAnswers($question)
    {
        $best = $question->answer()
            ->get()
            ->where('best', 1);
        $rest_answers = $question->answer()
            ->where('best', 0)
            ->orderBy('votes', 'desc')
            ->get();
        return $best->merge($rest_answers);
    }
    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);

        foreach ($question->category as $cat) {
            $category = Category::findOrFail($cat);
            $question->category()->detach($category);
        }
        
        $question->delete();
    }
}
