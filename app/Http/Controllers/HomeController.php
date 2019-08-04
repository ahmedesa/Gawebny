<?php

namespace App\Http\Controllers;

use App\Question;
use App\SiteSetting;
use App\Utilities\LastVistedQuestions;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(LastVistedQuestions $LastVistedQuestions)
    {
        if (request()->tab) {
            $tab = request()->tab;
            switch ($tab) {
                case "top":
                    $question = Question::orderBy('votes', 'desc')->paginate(10);
                    break;
                case "featured":
                    $question = Question::orderBy('created_at', 'desc')->paginate(10);
                    break;
                case "random":
                    $question = Question::inRandomOrder()->paginate(10);
                    break;
            }
            return view('Gawebny.home.home', compact('question'));
        }
        $question = Question::orderBy('id', 'desc')->paginate(10);
        $history_questions= $LastVistedQuestions->getQuestion();
        return view('Gawebny.home.home', compact('question','history_questions'));
    }

    public function Notification()
    {
        return view('Gawebny.notification');
    }

    public function Terms()
    {
        $terms = SiteSetting::Terms();
        return view('Gawebny.terms' ,compact('terms'));
    }
}
