<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\QuestionRequest;
use App\QVote;
use App\Question;
use App\SavedQ;
use App\Services\QuestionService;
use App\Utilities\LastVistedQuestions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class QuestionController extends Controller
{
    protected $questionService;
    public function __construct(QuestionService $questionService)
    {
        $this->questionService =$questionService;
        $this->middleware('auth')->except(['show']);
    }

    public function create(QuestionRequest $request)
    {
       $this->questionService->create($request);
        return back()->withFlashMessage('Question Posted Successfully');
    }

    public function show($id , LastVistedQuestions $LastVistedQuestions)
    {
        $question = Question::findOrFail($id);
        $LastVistedQuestions->addQuestion($question->id);
        $question->increment('views');
        $all_answeres = $this->questionService->getAllAnswers($question);
        $answerCount = $question->answer()->count();
        $relatedQuestion = $this->questionService->relatedQuestion($id);
        $locale = App::getLocale();
        return view('Gawebny.question.question', compact('question', 'answerCount', 'relatedQuestion', 'all_answeres', 'locale'));
    }

    public function edit($id, Request $request)
    {
        $question = Question::findOrFail($id);
        $question->body = $request->body;
        $question->save();
        return back()->withFlashMessage('The Question Has Been Modified Successfully');
    }

    public function destroy($id)
    {
        $this->questionService->deleteQuestion($id);
        return redirect('/')->withFlashMessage('The question Deleted Successfully');
    }

    public function upvote(Request $request )
    {
        if ($request->ajax()) {
            $id = $request->question_id;
            QVote::upvote($id, Auth::id());
            $QVotesCount = Question::find($id)->votes;
            return $QVotesCount;
        }
    }

    public function downvote(Request $request )
    {
        if ($request->ajax()) {
            $id = $request->question_id;
                        QVote::downvote($id, Auth::id());
            $QVotesCount = Question::find($id)->votes;
            return $QVotesCount;
        }
    }

    public function saveQuestion($id)
    {
        SavedQ::create([
            'user_id' => Auth::id(),
            'question_id' => $id,

        ]);
        return back()->withFlashMessage('saved');
    }

    public function UnSaveQuestion($id)
    {
        SavedQ::delete()->where('user_id', Auth::id())->where('question_id', $id);
        return back()->withFlashMessage('unsaved');
    }
}
