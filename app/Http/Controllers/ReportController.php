<?php

namespace App\Http\Controllers;

use App\AVote;
use App\Answer;
use App\Category;
use App\QVote;
use App\Question;
use App\Report;
use App\SavedQ;
use Illuminate\Http\Request;

class ReportController extends Controller
{
	public function send(Request $request)
	{
		Report::create([  
			"details"     => $request->details ,
			"user_id"     => $request->user_id ,
			"type"        => $request->type ,
			"reported_id" => $request->reported_id
		]);
		return back()->withFlashMessage('We Recived your report Successfully');
	}

	public function index()
	{
		$reports = Report::orderBy('created_at' ,'desc')->get();
		return view('dashbord.reports.index',compact('reports'));

	}
	public function show($id)
	{
		$report = Report::findOrFail($id);
		$report->seen = true ;
		$report->save();
		return view('dashbord.reports.view',compact('report'));
	}
	public function destroy($id)
	{
		Report::findOrFail($id)->delete();
		return back()->withFlashMessage('deleted successfully');
	}
	public function destroyAnswer($id)
	{
		Answer::findOrFail($id)->delete();
		AVote::where('answer_id' , $id)->delete();

		return back()->withFlashMessage('The Answer Deleted Successfully');

	}
	public function destroyQuestion($id)
	{
		$question = Question::findOrFail($id);
		foreach ($question->category as $cat) {
			$category = Category::findOrFail($cat);
			$question->category()->detach($category); 
		}
		$question->delete();
		return back()->withFlashMessage('The question Deleted Successfully');  
	}
}
