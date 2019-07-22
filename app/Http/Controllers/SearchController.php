<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->q) {
            $results = $this->GetResult($request);
            if ($request->time) {
                if (request()->time == 'week') {
                    $results->where('created_at', '>=',  Carbon::now()->subWeek());
                } elseif (request()->time == 'month') {
                    $results->where('created_at', '>=', Carbon::now()->subMonth());
                } elseif (request()->time == 'year') {
                    $results->where('created_at', '>=', Carbon::now()->subYear());
                }
            }
            return view('Gawebny.search.search',
            		[	'query'   => $request->q,
            	 		'results' => $results
            		]);
        } else {
            return redirect('/');
        }
    }

    public function GetResult($request)
    {
        if ($request->type) {
            switch (request()->type) {
                case 'question':
                    $results = Question::search($request->q, null, true)->paginate(10);
                    break;
                case 'profile':
                    $results = User::search($request->q, null, true)->paginate(10);
                    break;
                case 'answer':
                    $results = Answer::search($request->q, null, true)->paginate(10);
                    break;
                default:
                    $results = Question::search($request->q, null, true)->paginate(10);
                    break;
            }
        } else {
            $results = Question::search($request->q, null, true)->paginate(10);
        }
        return $results;
    }

    public function GetResultByTime($request) {}
}
