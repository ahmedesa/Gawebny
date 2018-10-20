<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Answer extends Model
{
	use SearchableTrait;

	protected $table = 'answer';
	protected $fillable = [
		'user_id' ,'question_id' ,  'body'

	];
	protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
        	'answer.body' => 10,
        ]
    ];
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
    public function User()
    {
    	return $this->belongsTo(User::class);
    }

    public static  function MakeBest($answer_id , $question_id)
    {
    	if (Self::thereIsBest($answer_id , $question_id)) {
    		$best_id = Self::where('question_id', $question_id)->where('best' , 1)->first()->id;	
    		if ($best_id ==$answer_id ) {
    			Self::ChangeBest($answer_id , 0 );

    		}else{
    			Self::ChangeBest($best_id , 0 );
    			Self::ChangeBest($answer_id , 1 );
    		}	
    	}else{
    		Self::ChangeBest($answer_id , 1 );
    	}
    }
    public static function thereIsBest($answer_id , $question_id)
    {
    	return Self::where('question_id', $question_id)->where('best' , 1)->first();
    }
    public static function ChangeBest($answer_id , $type)
    {
    	$answer=Self::find($answer_id);
    	$answer->best = $type ;
    	$answer->save();
    }
}


