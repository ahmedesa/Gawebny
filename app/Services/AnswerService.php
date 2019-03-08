<?php
namespace App\Services;
use App\Answer;
class AnswerService
{
    public function MakeBest($answer_id, $question_id)
    {
        if ($this->thereIsBest($answer_id, $question_id)) {
            $best_id = Answer::where('question_id', $question_id)->where('best', 1)->first()->id;
            if ($best_id == $answer_id) {
                $this->ChangeBest($answer_id, 0);
            } else {
                $this->ChangeBest($best_id, 0);
                $this->ChangeBest($answer_id, 1);
            }
        } else {
            $this->ChangeBest($answer_id, 1);
        }
    }

    public static function thereIsBest($answer_id, $question_id)
    {
        return Answer::where('question_id', $question_id)->where('best', 1)->first();
    }

    public static function ChangeBest($answer_id, $type)
    {
        $answer = Answer::find($answer_id);
        $answer->best = $type;
        $answer->save();
    }
}
