<?php
namespace App\Services;

use App\Question;
use App\QVote;

class QuestionVoteService
{
    public function upvote($question_id, $user_id)
    {
        $this->checkupvotes($question_id, $user_id);
    }

    public function downvote($question_id, $user_id)
    {
        $this->checkdownvotes($question_id, $user_id);
    }

    public function checkupvotes($question_id, $user_id)
    {
        /*is up voted*/
        if ($this->isUpVoted($user_id, $question_id)) {
            $this->cancelVote('1', QVote::where('user_id', $user_id)->where('vote', '1')->where('question_id', $question_id)->first()->id, $question_id);
            /*is downvoted*/
        } elseif ($this->isDownVoted($user_id, $question_id)) {
            $this->cancelVote('0', QVote::where('user_id', $user_id)->where('vote', '0')->where('question_id', $question_id)->first()->id, $question_id);
            return $this->vote($question_id, '1', $user_id);
        } else {
            return $this->vote($question_id, '1', $user_id);
        }
    }

    public function checkdownvotes($question_id, $user_id)
    {
        /*the user dwonvoted*/
        if ($this->isDownVoted($user_id, $question_id)) {
            $this->cancelVote('0', $vote_id = QVote::where('user_id', $user_id)->where('vote', '0')->where('question_id', $question_id)->first()->id, $question_id);
            /*the user upvoted*/
        } elseif ($this->isUpVoted($user_id, $question_id)) {
            $this->cancelVote('1', $vote_id = QVote::where('user_id', $user_id)->where('vote', '1')->where('question_id', $question_id)->first()->id, $question_id);
            return $this->vote($question_id, '0', $user_id);
        } else {
            return $this->vote($question_id, '0', $user_id);
        }
    }

    public function cancelVote($type, $vote_id, $question_id)
    {
        if ('1' == $type) {
            Question::find($question_id)->decrement('votes');
            QVote::find($vote_id)->delete($vote_id);
        } elseif ('0' == $type) {
            Question::find($question_id)->increment('votes');
            QVote::find($vote_id)->delete($vote_id);
        }
    }

    public function vote($question_id, $type, $user_id)
    {
        QVote::create([
            'question_id' => $question_id,
            'user_id' => $user_id,
            'vote' => $type,
        ]);
        if (1 == $type) {
            Question::find($question_id)->increment('votes');
/*
$user_question =User::find(Question::find($question_id)->user_id);

if ($user_id !=$user_question) {

if ($user_question->notifications()->where('data','Like' ,'%"id":14%')->where('type' ,'App\Notifications\NewQUpvote')->get()) {
$user_question->notifications()->where('data','Like' ,'%"id":14%')->where('type' ,'App\Notifications\NewQUpvote')->delete();
}

$user_question->notify(new NewQUpvote(Question::find($question_id)));
SendNotification(
' <strong> '.trans('layout.new_upvote').' '. str_limit(Question::find($request->question_id)->title , 10).' </strong>'
,url('question/'.Question::find($request->question_id)->id.''.str_slug(Question::find($request->question_id)->title))
,'about a minute ago');
}
 */
        } elseif (0 == $type) {
            Question::find($question_id)->decrement('votes');
        }
    }

    public static function isUpVoted($user_id, $question_id)
    {
        return QVote::where('user_id', $user_id)->where('vote', '1')->where('question_id', $question_id)->first();
    }

    public static function isDownVoted($user_id, $question_id)
    {
        return QVote::where('user_id', $user_id)->where('vote', '0')->where('question_id', $question_id)->first();
    }
}
