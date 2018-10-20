<?php
namespace App;

use App\Answer;
use Illuminate\Database\Eloquent\Model;

class AVote extends Model
{
	protected  $table = 'avote';
	protected $fillable = [
		'answer_id' , 'user_id' , 'vote'
	];
	public static  function upvote($Answer_id , $user_id)
	{
		$_this = new self;
		$_this->checkupvotes($Answer_id , $user_id);
	}

	public static  function downvote($Answer_id , $user_id)
	{
		$_this = new self;
		$_this->checkdownvotes($Answer_id , $user_id);
	}

	public function checkupvotes($Answer_id , $user_id)
	{
		/*is up voted*/
		if ($this->isUpVoted($user_id , $Answer_id)) {
			$this->cancelVote('1' , Self::where('user_id' , $user_id)->where('vote' , '1')->where('answer_id',$Answer_id)->first()->id , $Answer_id);
			/*is downvoted*/
		}elseif ($this->isDownVoted($user_id , $Answer_id)) {
			$this->cancelVote('0' , Self::where('user_id' , $user_id)->where('vote' , '0')->where('answer_id',$Answer_id)->first()->id , $Answer_id);
			return $this->vote($Answer_id , '1' , $user_id);
		}else{
			return $this->vote($Answer_id , '1' , $user_id);
		}
	}

	public function checkdownvotes($Answer_id , $user_id)
	{
		/*the user dwonvoted*/
		if ($this->isDownVoted($user_id , $Answer_id)) {
			$this->cancelVote('0' , $vote_id =  Self::where('user_id' , $user_id)->where('vote' , '0')->where('answer_id',$Answer_id)->first()->id ,$Answer_id);
			/*the user upvoted*/
		}elseif ($this->isUpVoted($user_id , $Answer_id )) {
			$this->cancelVote('1' , $vote_id = Self::where('user_id' , $user_id)->where('vote' , '1')->where('answer_id',$Answer_id)->first()->id , $Answer_id);
			return $this->vote($Answer_id , '0' , $user_id);
		}else{
			return $this->vote($Answer_id , '0' , $user_id);
		}
	}

	public function cancelVote($type ,$vote_id ,$Answer_id)
	{
		if ($type =='1') {
			Answer::find($Answer_id)->decrement('votes');
			Self::find($vote_id)->delete($vote_id);
		}elseif ($type == '0') {
			Answer::find($Answer_id)->increment('votes');
			Self::find($vote_id)->delete($vote_id);
		}
	}
	public function vote($Answer_id , $type , $user_id)
	{
		Self::create([
			'answer_id' =>    $Answer_id , 
			'user_id'     =>    $user_id , 
			'vote'        =>    $type
		]);
		if ($type == 1 ) {
			Answer::find($Answer_id)->increment('votes');
		}elseif ($type == 0) {
			Answer::find($Answer_id)->decrement('votes');

		}
	}

	public static function isUpVoted($user_id , $Answer_id)
	{
		return Self::where('user_id' , $user_id)->where('vote' , '1')->where('answer_id',$Answer_id)->first();
	}
	public static function isDownVoted($user_id , $Answer_id)
	{
		return Self::where('user_id' , $user_id)->where('vote' , '0')->where('answer_id',$Answer_id)->first();
	}
}
