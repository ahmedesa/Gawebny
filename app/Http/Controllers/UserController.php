<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Question;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except(['profile', 'savedQuestion', 'UserVotes', 'UserAnswers']);
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        if (request()->order) {
            if (request()->order == 'recnet') {
                $user_questions = $user->question()->orderBy('created_at', 'desc')->paginate(5);
            }

            if (request()->order == 'votes') {
                $user_questions = $user->question()->orderBy('votes', 'desc')->paginate(5);
            }
        } else {
            $user_questions = $user->question()->paginate(5);
        }
        return view('Gawebny.profile.profile', compact('user', 'user_questions'));
    }

    public function savedQuestion($id)
    {

        $user = User::findOrFail($id);
        if (request()->order) {
            if (request()->order == 'recnet') {
                $saved_questions = Question::whereHas('savedq', function ($q) use ($id) {$q->where('user_id', '=', $id);})->orderBy('created_at', 'desc')->paginate(5);
            }

            if (request()->order == 'votes') {
                $saved_questions = Question::whereHas('savedq', function ($q) use ($id) {$q->where('user_id', '=', $id);})->orderBy('votes', 'desc')->paginate(5);
            }
        } else {
            $saved_questions = Question::whereHas('savedq', function ($q) use ($id) {$q->where('user_id', '=', $id);})->paginate(5);}

        return view('Gawebny.profile.saved', compact('user', 'saved_questions'));
    }

    public function UserVotes($id)
    {
        $user = User::findOrFail($id);
        $saved_questions = Question::with('userLikes')->get();
        return view('Gawebny.profile.votes', compact('user', 'saved_questions'));
    }

    public function UserAnswers($id)
    {
        $user = User::findOrFail($id);
        if (request()->order) {
            if (request()->order == 'recnet') {
                $user_answers = $user->answer()->orderBy('created_at', 'desc')->paginate(5);
            }

            if (request()->order == 'votes') {
                $user_answers = $user->answer()->orderBy('votes', 'desc')->paginate(5);
            }
        } else {
            $user_answers = $user->answer()->paginate(5);
        }
        return view('Gawebny.profile.answers', compact('user', 'user_answers'));
    }

    public function settings()
    {
        $user = User::findOrFail(Auth::id());
        return view('Gawebny.profile.information_settings', compact('user'));
    }

    public function informationSetting()
    {
        $user = User::findOrFail(Auth::id());
        return view('Gawebny.profile.settings', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        if ($request->file('image')) {
            if ('defualt.png' != $user->image) {
                if (file_exists(base_path() . '/public/Gawebny/img/' . $user->image)) {
                    unlink(base_path() . '/public/Gawebny/img/' . $user->image);
                }
            }
            $image = uplodeImg($request->file('image'));

            $user->update(['image' => $image]);
        }
        $user->update($request->except(['_token', '_method', 'image']));
        return back()->withFlashMessage('Settings Updated Successfully');
    }

    public function updateUserSettings(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $this->validate($request, [
            'username' => 'required|max:30|min:3|string|alpha_dash',
            'email' => 'required|string|email|max:50|unique:users,email,' . $user->id,
        ]);
        $user = User::findOrFail(Auth::id());
        $user->update($request->except(['_token', '_method', 'image']));
        return back()->withFlashMessage('Settings Updated Successfully');
    }

    public function updateUserPassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The Old Password Is Wrong ']);
        }
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->update([
            "password" => Hash::make($request->password),
        ]);
        return back()->withFlashMessage('Settings Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user_name = $user->name;
        if ('defualt.png' != $user->image) {
            if (file_exists(base_path() . '/public/Gawebny/img/' . $user->image)) {
                unlink(base_path() . '/public/Gawebny/img/' . $user->image);
            }
        }
        $user->delete();
        return back()->whithFlashMessage('User Delated' . $user_name . ' Successfully');
    }

    public function MakeAdmin($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->admin = $request->admin;
        $user->save();
        return back();
    }
}
