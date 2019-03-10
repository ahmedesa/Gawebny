<?php

namespace App;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';
    protected $fillable = ['user_id', 'type', 'details', 'reported_id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function link()
    {

        switch ($this->type) {
            case 'question':
                if (Question::find($this->reported_id)) {
                    $question= Question::find($this->reported_id);
                    return $question->slug;
                } else {
                    return '#';
                }
            case 'user':
                if (User::find($this->reported_id)) {
                    return url('profile/' . $this->reported_id);
                } else {
                    return '#';
                }case 'answer':
                if (Answer::find($this->reported_id)) {
                    $answer = Answer::findOrFail($this->reported_id);
                    return $answer->slug;
                } else {
                    return '#';
                }
        }
    }

    public function delete()
    {
        switch ($this->type) {
            case 'question':
                return url('/dashbord/question/' . $this->reported_id . '/delete');
            case 'user':
                return url('/dashbord/users/' . $this->reported_id . '/delete');
            case 'answer':
                return url('/dashbord/answer/' . $this->reported_id . '/delete');
        }
    }
}
