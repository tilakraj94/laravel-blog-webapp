<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hash;
use App\Notifications\ChangePassword as ChangePass;

class ChangePassword extends Controller
{
  public function __construct(){
  $this->middleware('auth');
  }

  public function showChangePassword(){
    return view('auth.changePassword');
  }

  public function reset(Request $request){
    $this->validate($request,[
      'old_password'=>'required',
      'password'=>'required|min:6|confirmed',
      'password_confirmation'=>'required',
    ]);


    try {
        $user=User::findOrFail(Auth::id());
    } catch (ModelNotFoundException $e) {
      return redirect()->route('home')->withErrors('User not Found, if this error persists.Please contact:foodquo@gmail.com');
    }


    if(Hash::check($request->old_password,$user->password))
    {
      $user->password=Hash::make($request->password);
      $user->save();
      $user->notify(new ChangePass);
      Session::flash('success','Password has been successfully changed.');
      return redirect()->route('home');
    }else return redirect()->back()->withInput()->withErrors('The old password is incorrect.');
  }
}
