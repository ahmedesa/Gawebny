<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Answer extends Model
{
    use SearchableTrait;

    protected $table = 'answer';
    protected $fillable = [
        'user_id', 'question_id', 'body',

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
        ],
    ];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
