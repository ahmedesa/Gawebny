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
		$query = $request->q ;
		if ($request->q) {
			if ($request->type) {
				if (request()->type == 'question') {
					$results = Question::search($query , null , true)->paginate(10);
				}elseif (request()->type == 'profile') {
					$results = User::search($query, null , true)->paginate(10);

				}elseif (request()->type == 'answer') {
					$results = Answer::search($query, null , true)->paginate(10);
				}
			}else{
				$results = Question::search($query , null , true)->paginate(10);
			}
			if ($request->time) {
				if (request()->time == 'week') {
					$results->where('created_at', '>' , Carbon::now()->subWeek());
				}elseif (request()->time == 'month') {
					$results->where('created_at', '>=', Carbon::now()->subMonth());
				}elseif (request()->time == 'year') {
					$results->where('created_at', '>=', Carbon::now()->subYear());
				}
			}
			return view('Gawebny.search.search' ,compact('query' , 'results'));

		}else{
			return redirect('/');
		}
	}}
