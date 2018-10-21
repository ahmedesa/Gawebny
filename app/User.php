<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;


class User extends Authenticatable /* implements  MustVerifyEmail */
{
    use SearchableTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'users.name' => 10,
            'users.jop' => 7,
            'users.education' => 5,
            'users.discreption' => 5,

        ]
    ];
    protected $fillable = [
        'name', 'email', 'password', 'country_id', 'education', 'jop','discreption', 'language_id','image',
        'connection_account' ,'admin' ,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected static function boot(){
        parent::boot();
        static::deleting(function ($user) {
            $user->question->each->delete();
            $user->answer->each->delete();
            $user->avote->each->delete();
            $user->qvote->each->delete();

        });
    }
    public function question()
    {
        return $this->hasMany(Question::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
    public function avote()
    {
        return $this->hasMany(AVote::class);
    }
    public function qvote()
    {
        return $this->hasMany(QVote::class);
    }
    public function savedq()
    {
        return $this->hasMany(SavedQ::class);
    }

    public function location()
    {

        return $this->belongsTo(Country::class ,'country_id');
    }
    public function language()
    {

        return $this->belongsTo(Language::class ,'language_id');
    }

    public function CountVotes()
    {
        $countv = 0;
        $counta = 0;
        foreach ($this->question as $q) {
            $countv = $countv + $q->votes;
        }
        foreach ($this->answer as $q) {
            $counta = $counta + $q->votes;
        }
        return $counta +$countv ;   
    }
}
