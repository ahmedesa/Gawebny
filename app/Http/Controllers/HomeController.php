<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{

/*    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    public function index()
    {
        return view('home');
    }

    public function Notification()
    {
        return view('Gawebny.notification');
    }

    public function Terms()
    {
        return view('Gawebny.terms');
    }
}
