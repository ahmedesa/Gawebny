<?php
namespace App\Services;

use App\Answer;
use App\AVote;

class AnswerVoteService
{

    public function upvote($Answer_id, $user_id)
    {
        $this->checkupvotes($Answer_id, $user_id);
    }

    public function downvote($Answer_id, $user_id)
    {
        $this->checkdownvotes($Answer_id, $user_id);
    }

    public function checkupvotes($Answer_id, $user_id)
    {
        /*is up voted*/
        if ($this->isUpVoted($user_id, $Answer_id)) {
            $this->cancelVote('1', AVote::where('user_id', $user_id)->where('vote', '1')->where('answer_id', $Answer_id)->first()->id, $Answer_id);
            /*is downvoted*/
        } elseif ($this->isDownVoted($user_id, $Answer_id)) {
            $this->cancelVote('0', AVote::where('user_id', $user_id)->where('vote', '0')->where('answer_id', $Answer_id)->first()->id, $Answer_id);
            return $this->vote($Answer_id, '1', $user_id);
        } else {
            return $this->vote($Answer_id, '1', $user_id);
        }
    }

    public function checkdownvotes($Answer_id, $user_id)
    {
        /*the user dwonvoted*/
        if ($this->isDownVoted($user_id, $Answer_id)) {
            $this->cancelVote('0', $vote_id = AVote::where('user_id', $user_id)->where('vote', '0')->where('answer_id', $Answer_id)->first()->id, $Answer_id);
            /*the user upvoted*/
        } elseif ($this->isUpVoted($user_id, $Answer_id)) {
            $this->cancelVote('1', $vote_id = AVote::where('user_id', $user_id)->where('vote', '1')->where('answer_id', $Answer_id)->first()->id, $Answer_id);
            return $this->vote($Answer_id, '0', $user_id);
        } else {
            return $this->vote($Answer_id, '0', $user_id);
        }
    }

    public function cancelVote($type, $vote_id, $Answer_id)
    {
        if ('1' == $type) {
            Answer::find($Answer_id)->decrement('votes');
            AVote::find($vote_id)->delete($vote_id);
        } elseif ('0' == $type) {
            Answer::find($Answer_id)->increment('votes');
            AVote::find($vote_id)->delete($vote_id);
        }
    }

    public function vote($Answer_id, $type, $user_id)
    {
        AVote::create([
            'answer_id' => $Answer_id,
            'user_id' => $user_id,
            'vote' => $type,
        ]);
        if (1 == $type) {
            Answer::find($Answer_id)->increment('votes');
        } elseif (0 == $type) {
            Answer::find($Answer_id)->decrement('votes');
        }
    }

    public static function isUpVoted($user_id, $Answer_id)
    {
        return AVote::where('user_id', $user_id)->where('vote', '1')->where('answer_id', $Answer_id)->first();
    }

    public static function isDownVoted($user_id, $Answer_id)
    {
        return AVote::where('user_id', $user_id)->where('vote', '0')->where('answer_id', $Answer_id)->first();
    }
}
