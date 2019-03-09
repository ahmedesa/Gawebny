<?php

namespace App;

use App\Question;
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
        'columns' => [
            'answer.body' => 10,
        ],
    ];
    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        $question = Question::find($this->question_id);
        return route('question',['id' =>$this->question_id ,'slug' => str_slug($question->title) ]).'#comment'.$this->id;
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
