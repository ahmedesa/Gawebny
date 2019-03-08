<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Question extends Model
{
    use SearchableTrait;
    protected $table = 'question';

    protected $searchable = [
        'columns' => [
            'question.title' => 10,
            'question.body' => 2,
        ],
    ];

    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return route('question',['id' =>$this->id ,'slug' => str_slug($this->title) ]);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class)->orderBy('votes', 'desc');
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
