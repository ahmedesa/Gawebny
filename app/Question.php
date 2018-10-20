<?php

namespace App;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	use SearchableTrait;
	protected $table = 'question';
	protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
        	'question.title' => 10,
        	'question.body' => 2,
        ]
    ];
        public function category()
    {
    	return	$this->belongsToMany(Category::class);
    }
    public function User()
    {
    	return $this->belongsTo(User::class);
    }
    public function answer()
    {
    	return $this->hasMany(Answer::class)->orderBy('votes' ,'desc' );
    }
      public function savedq() 
    {
        return $this->hasMany(SavedQ::class);
    }
    public function userLikes()
{
    return $this->hasMany(SavedQ::class)->where('user_id', auth()->id());
}
}
