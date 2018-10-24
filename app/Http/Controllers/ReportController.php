<?php

namespace App\Http\Controllers;

use App\Report;
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
}
