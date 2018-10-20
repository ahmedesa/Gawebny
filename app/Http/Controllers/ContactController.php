<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
	public function index()
	{
		return view('Gawebny.contact');
	}

	public function save(Request $request)
	{
		Contact::create($request->except('_token'));

		return back()->withFlashMessage('Your message has been sent successfully');
	}

	public function dashbordIndex()
	{
		$messages = Contact::orderBy('created_at' ,'desc')->get();
		return view('dashbord.messages.index',compact('messages'));

	}
	public function show($id)
	{
		$message = Contact::findOrFail($id);
		$message->seen = true ;
		$message->save();
		return view('dashbord.messages.view',compact('message'));
	}
}
