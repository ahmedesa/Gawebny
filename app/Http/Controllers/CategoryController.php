<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function index($slug)
	{
		$category=Category::where('name_en' , $slug)->get();
		$question = Question::whereHas('category', function($q) use ($slug) {
			$q->where('name_en', $slug);
		})->get();
		$questioncount = Question::whereHas('category', function($q) use ($slug) {
			$q->where('name_en', $slug);
		})->count();
		return view('Gawebny.category.category' , compact('category' , 'question' , 'questioncount'));
	}

	public function dashIndex()
	{
		$categories = Category::all();
		return view('dashbord.categories.index' , compact('categories'));

	}
	public function destroy($id)
	{
		$category = Category::find($id) ;
		$category_name = $category->name_en; 
		$category->delete();
		return back()->withFlashMessage('Category  '.$category_name.' Deleted Successfully');

	}
	public function create(Request $request)
	{
		Category::create([
			'name_en' => $request->name_en,
			'name_ar' => $request->name_ar,
		]);
		return back()->withFlashMessage('Category '.$request->name_en.' created Successfully');

	}
	public function update($id , Request $request)
	{
		$cat =	Category::find($id);
		$cat->name_en = $request->name_en;
		$cat->name_ar = $request->name_ar;
		$cat->save();
		return back()->withFlashMessage('Category '.$request->name_en.' created Successfully');

	}





}
