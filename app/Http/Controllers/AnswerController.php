<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AVote;
use App\Notifications\NewAnswer;
use App\Notifications\NewMention;
use App\Question;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Services\AnswerService;

class AnswerController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function CreateAnswer(Request $request)
    {
        $answer = Answer::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
            'body' => $request->answer,
        ]);

        $mention = CheckExistMention($request->answer);
        if ($mention) {
            foreach ((array) $mention as $key) {
                if (User::where('name', $key)->first()) {
                    $user = User::where('name', $key)->first();
                    $user->notify(new NewMention($answer));
                    SendNotification('  <strong> ' . Auth::user()->name . '</strong> ' . trans('layout.new_mention'), url('/question/' . $answer->question_id . '#comment' . $answer->id), 'about a minute ago', $user->id);
                }
            }
        }
        $user_question = Question::find($request->question_id)->user_id;
        if (Auth::id() != $user_question) {
            User::find($user_question)->notify(new NewAnswer(Question::find($request->question_id)));

            SendNotification(
                ' <strong> ' . trans('layout.new_question') . ' ' . str_limit(Question::find($request->question_id)->title, 10) . ' </strong>'
                , url('question/' . Question::find($request->question_id)->id . '/' . str_slug(Question::find($request->question_id)->title))
                , 'about a minute ago', $user_question);
        }
        return back()->withFlashMessage('The Answer Posted Successfully');
    }

    public function destroy($id)
    {
        Answer::findOrFail($id)->delete();

        return back()->withFlashMessage('The Answer Deleted Successfully');
    }

    public function MakeBest($id, AnswerService $answerService)
    {
        $answerService->MakeBest($id, Answer::findOrFail($id)->question->id);
        
        return back();
    }

    public function upvote(Request $request )
    {
        if ($request->ajax()) {
            $id = $request->answer_id;
            AVote::upvote($id, Auth::id());
            $AnsVotesCount = Answer::find($id)->votes;
            return $AnsVotesCount;
        }
    }

    public function downvote(Request $request )
    {
        if ($request->ajax()) {
            $id = $request->answer_id;
            AVote::downvote($id, Auth::id());

            $AnsVotesCount = Answer::find($id)->votes;
            return $AnsVotesCount;
        }
    }
}
