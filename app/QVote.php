<?php

namespace App;

use App\Notifications\NewQUpvote;
use App\Question;
use App\User;
use Illuminate\Database\Eloquent\Model;

class QVote extends Model
{
	protected  $table = 'qvotes';
	protected $fillable = [
		'question_id' , 'user_id' , 'vote'
	];
	public static  function upvote($question_id , $user_id)
	{
		$_this = new self;
		$_this->checkupvotes($question_id , $user_id);
	}

	public static  function downvote($question_id , $user_id)
	{
		$_this = new self;
		$_this->checkdownvotes($question_id , $user_id);
	}

	public function checkupvotes($question_id , $user_id)
	{
		/*is up voted*/
		if ($this->isUpVoted($user_id , $question_id)) {
			$this->cancelVote('1' , Self::where('user_id' , $user_id)->where('vote' , '1')->where('question_id',$question_id)->first()->id , $question_id);
			/*is downvoted*/
		}elseif ($this->isDownVoted($user_id , $question_id)) {
			$this->cancelVote('0' , Self::where('user_id' , $user_id)->where('vote' , '0')->where('question_id',$question_id)->first()->id , $question_id);
			return $this->vote($question_id , '1' , $user_id);
		}else{
			return $this->vote($question_id , '1' , $user_id);
		}
	}

	public function checkdownvotes($question_id , $user_id)
	{
		/*the user dwonvoted*/
		if ($this->isDownVoted($user_id , $question_id)) {
			$this->cancelVote('0' , $vote_id =  Self::where('user_id' , $user_id)->where('vote' , '0')->where('question_id',$question_id)->first()->id ,$question_id);
			/*the user upvoted*/
		}elseif ($this->isUpVoted($user_id , $question_id )) {
			$this->cancelVote('1' , $vote_id = Self::where('user_id' , $user_id)->where('vote' , '1')->where('question_id',$question_id)->first()->id , $question_id);
			return $this->vote($question_id , '0' , $user_id);
		}else{
			return $this->vote($question_id , '0' , $user_id);
		}
	}

	public function cancelVote($type ,$vote_id ,$question_id)
	{
		if ($type =='1') {
			Question::find($question_id)->decrement('votes');
			Self::find($vote_id)->delete($vote_id);
		}elseif ($type == '0') {
			Question::find($question_id)->increment('votes');
			Self::find($vote_id)->delete($vote_id);
		}
	}
	public function vote($question_id , $type , $user_id)
	{
		Self::create([
			'question_id' =>    $question_id , 
			'user_id'     =>    $user_id , 
			'vote'        =>    $type
		]);
		if ($type == 1 ) {
			Question::find($question_id)->increment('votes');
			$user_question =User::find(Question::find($question_id)->user_id);

			if ($user_id !=$user_question) {

				if ($user_question->notifications()->where('data','Like' ,'%"id":14%')->where('type' ,'App\Notifications\NewQUpvote')->get()) {
					$user_question->notifications()->where('data','Like' ,'%"id":14%')->where('type' ,'App\Notifications\NewQUpvote')->delete();
				}
				$user_question->notify(new NewQUpvote(Question::find($question_id)));
			}

		}elseif ($type == 0) {
			Question::find($question_id)->decrement('votes');

		}
	}

	public static function isUpVoted($user_id , $question_id)
	{
		return Self::where('user_id' , $user_id)->where('vote' , '1')->where('question_id',$question_id)->first();
	}
	public static function isDownVoted($user_id , $question_id)
	{
		return Self::where('user_id' , $user_id)->where('vote' , '0')->where('question_id',$question_id)->first();
	}
}
