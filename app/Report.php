<?php

namespace App;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table ='report';
	protected $fillable = ['user_id','type','details' ,'reported_id'];
	
	public function User()
	{
		return $this->belongsTo(User::class);
	}
	public function link()
	{
		if ($this->type =='question') {
			if (Question::find($this->reported_id)) {
				
				$question_title = Question::findOrFail($this->reported_id)->title ;
				return url('question/'.$this->reported_id.'/'.str_slug($question_title)  ) ;
			}else {
				return'#';
			}

		} elseif ($this->type =='user') {
			if (User::find($this->reported_id)) {
				return url('profile/'.$this->reported_id);

			}else{
				return '#';
			}

		}elseif ($this->type =='answer') {
			if (Answer::find($this->reported_id)) {
				
				$answer =Answer::findOrFail($this->reported_id);
				return url('/question/'.$answer->question->id.'/'.str_slug($answer->question->body)).'#comment'.$this->reported_id;
			}else {
				return '#';
			}


		}

	}
	public function delete()
	{
		if ($this->type =='question') {
			return url('/dashbord/question/'.$this->reported_id.'/delete');
		} elseif ($this->type =='user') {
			return url('/dashbord/users/'.$this->reported_id.'/delete');
		}elseif ($this->type =='answer') {
			return url('/dashbord/answer/'.$this->reported_id.'/delete');


		}
	}

}
