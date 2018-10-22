<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
	public function index()
	{
		$settings = SiteSetting::all();
		return view('dashbord.sitesetting' , compact('settings'));
	}
	public function update(Request $request , SiteSetting $sitesetting)
	{
		$this->validate($request,[
				'logo' => 'image|mimes:jpeg,bmp,png,jpg',
			]);
		foreach ($request->except(['_token','_method' ,'logo'] )  as $key =>$req) {
			$sitesettingUpdate = $sitesetting->where('name',$key)->get()[0]; 
			$sitesettingUpdate->fill([
				'value' => $req
			])->save();

		}
		if ($request->file('logo')) {
			$logo =uplodeImg($request->file('logo'));
			$sitesettingUpdate = $sitesetting->where('name','logo')->get()[0]; 
			$sitesettingUpdate->fill([
				'value' => $logo
			])->save();

		}
		return back()->withFlashMessage('Site Settings Updated Successfully');
	}
}
