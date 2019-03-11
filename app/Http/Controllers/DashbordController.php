<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Question;
use App\Services\CategoryService;
use App\SiteSetting;
use App\User;

class DashbordController extends Controller
{
    public function index(CategoryService $categoryService)
    {
        $allAnswer = Answer::all()->count();
        $allQuestion = Question::all()->count();
        $allUser = User::all()->count();
        $lastQuestions = Question::orderBy("created_at", 'desc')->take(5)->get();
        $lastUsers = User::orderBy("created_at", 'desc')->take(5)->get();
        $TopCategories = Category::withCount('question')->latest('question_count')->take(5)->get();
        $settings = SiteSetting::getAllSettings();
        $categoryPercantage = $categoryService->percantage();
        return view('dashbord.home.index', compact(
            'allAnswer',
            'allQuestion',
            'allUser',
            'lastQuestions',
            'lastUsers',
            'TopCategories',
            'settings',
            'categoryPercantage'

        ));
    }

    public function users($id = null)
    {
        if (null == $id) {
            $users = User::all();
            return view('dashbord.users.index', compact('users'));
        } else {
            $user = User::findOrFail($id);
            return view('dashbord.users.view', compact('user'));
        }
    }

    public function answers()
    {
        $answers = Answer::all();
        return view('dashbord.answers.index', compact('answers'));
    }
}
