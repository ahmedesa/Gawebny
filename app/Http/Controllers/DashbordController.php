<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Contact;
use App\Question;
use App\SiteSetting;
use App\User;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
	public function index()
	{
		$allAnswer = Answer::all()->count();
		$allQuestion = Question::all()->count();
		$allUser = User::all()->count();
		$lastQuestions =Question::orderBy("created_at",'desc')->take(5)->get();
		$lastUsers =User::orderBy("created_at",'desc')->take(5)->get();
		$TopCategories = Category::withCount('question')->latest('question_count')->take(5)->get();
		$settings =SiteSetting::all();
		return view('dashbord.home.index',compact(
			'allAnswer','allQuestion','allUser' ,'lastQuestions' ,'lastUsers',
			'TopCategories' ,'settings'

		));

	}
	public function users($id = null)
	{
		if ($id == null) {

			$users = User::all();
			return view('dashbord.users.index',compact('users'));

		}else{
			$user =User::findOrFail($id) ;

			return view('dashbord.users.view',compact('user'));


		}
	}
}
