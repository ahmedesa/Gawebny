<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\SocialAccunt;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider($SocialProvider)
    {
      return Socialite::driver($SocialProvider)->redirect();
    }
    public function handleCallback($SocialProvider)
    {
      $provider =  Socialite::driver($SocialProvider)->user();
      $account = SocialAccunt::where('provider',$SocialProvider)->where('provider_user_id' , $provider->getId())->first();
      if ($account) {
        $user = $account->user;
      }else {
        $akun = new SocialAccunt([
          'provider_user_id' => $provider->getId() ,
          'provider' => $SocialProvider
        ]);
        $orang = User::where('email' , $provider->getEmail())->first();
        $theName =str_replace(' ' ,'_',trim($provider->getName()));
        $NewUserName=$theName; 
        if (User::where('name' ,$theName)->first()) {
          while ( User::where('name' ,$NewUserName)->first()) {
            $NewUserName=$theName.rand(0,1000);
          }
        }
        if (!$orang) {
         $orang =  User::create([
          'name'     =>$NewUserName,
          'email'    =>$provider->getEmail(),
          'password' => '',
          'varified' => '1' ,
          'image'    =>'defualt.png'
        ]);
       }
       $akun->user()->associate($orang);
       $akun->save();
       $user = $orang;
     }
     auth()->login($user);
     return redirect()->to('/');
   }
 }
