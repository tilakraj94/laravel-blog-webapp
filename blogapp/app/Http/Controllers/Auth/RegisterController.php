<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Session;
use Mail;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Notifications\AccountActivation;
use App\Profile;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By defaults this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:blog_users',
            'password' => 'required|min:6|confirmed',
            'username'=>'required|unique:blog_users|max:100|regex:/[A-Za-z0-9.@_]/'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username'=>$data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }



     public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        //Mail::to($user->email)->send(new AccountActivation($user));

        $user->notify(new AccountActivation($user));
        Session::flash('success','Please confirm you email account.');
        return redirect()->back();
    }


    public function registerConfirm($token,Request $request){
        $user=User::where('email',$request->email)->where('remember_token',$token)->limit(1)->get();
        if($user->count()>0){
            foreach ($user as $user) {
              $user=$user;
             }
            $user->remember_token=null;
            $user->validated=1;
            $user->save();
            $profile=new Profile;
            $profile->user()->associate($user);
            $profile->save();
            Session::flash('success','Your account has been verified,please log in with your credentials.');
            return view('auth.login');
        }
        return view('auth.register')->withErrors('The token has expired or the user doesnot exist.');
    }
}
