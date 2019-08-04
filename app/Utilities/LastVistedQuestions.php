<?php 
namespace App\Utilities;

use App\Question;
use Illuminate\Support\Facades\Session;

class LastVistedQuestions
{
    private const MAX = 3;

    public function addQuestion($question_id) : void
    {
        $questions = $this->getQuestionsIds();

        array_unshift($questions, $question_id);

        $questions = array_unique($questions);

        $questions = array_slice($questions, 0, self::MAX);
       
        Session::put('questions_history', $questions);

    }
 
    public function getQuestionsIds() : array
    {
        return Session::get('questions_history', []);

    }

    public function getQuestion() : array
    {
        $questions = [];

        foreach ($this->getQuestionsIds() as $question_id) {
            $questions[] = Question::find($question_id);
        }

        return $questions;
    }
}