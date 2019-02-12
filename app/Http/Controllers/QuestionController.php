<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Http\Requests\QuestionRequest;
use App\Question;
use App\QVote;
use App\SavedQ;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class QuestionController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
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
        return view('Gawebny.home.home', compact('question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionRequest $request)
    {
        if (substr(trim($request->title), -1) == '?') {
            $nweTitle = trim($request->title);
        } else {
            $nweTitle = trim($request->title) . '?';
        }
        $question = new Question;
        if (isset($request->anonymous)) {
            $question->anonymous = $request->anonymous;
        }
        $question->title = $nweTitle;
        $question->body = $request->body;
        $question->user_id = Auth::id();
        $question->save();
        foreach ($request->category as $cat) {
            $category = Category::findOrFail($cat);
            $question->category()->attach($category);
        }
        return back()->withFlashMessage('Question Posted Successfully');
    }

    public function show($id)
    {
        //dd($id , request()->url());
        $question = Question::findOrFail($id);
        $question->increment('views');
        $best = $question->answer()->get()->where('best', 1);
        $normal_ans = $question->answer()->where('best', 0)->orderBy('votes', 'desc')->get();
        $all_answeres = $best->merge($normal_ans);
        $answerCount = $question->answer()->count();
        /*foreach ($question->category as $cat) {
        # code...
        }*/
        $questioncat = $question->category[0]->name_en;
        $relatedQuestion = Question::whereHas('category', function ($q) use ($questioncat) {
            $q->where('name_en', $questioncat);
        })->where('id', '!=', $id)->take(5)->inRandomOrder()->get();
        $locale = App::getLocale();

        return view('Gawebny.question.question', compact('question', 'answerCount', 'relatedQuestion', 'all_answeres', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $question = Question::findOrFail($id);
        $question->body = $request->body;
        $question->save();
        return back()->withFlashMessage('The Question Has Been Modified Successfully');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        foreach ($question->category as $cat) {
            $category = Category::findOrFail($cat);
            $question->category()->detach($category);
        }
        QVote::where('question_id', $id)->delete();
        SavedQ::where('question_id', $id)->delete();
        Answer::where('question_id', $id)->delete();
        $question->delete();
        return redirect('/')->withFlashMessage('The question Deleted Successfully');
    }

    public function upvote(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->question_id;
            QVote::upvote($id, Auth::id());
            $QVotesCount = Question::find($id)->votes;
            return $QVotesCount;
        }
    }

    public function downvote(Request $request)
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
