<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Image;
use Session;
use App\Http\Requests\changePasswordRequest;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth',['except'=>['show']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::where('username',$id)->limit(1)->get();
        if($user->count()>0){
            foreach ($user as $user) {
               return view('profiles.show')->withUser(User::find($user->id));
            }
        }
        abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::where('username',$id)->limit(1)->get();
        if($user->count()>0){
            foreach ($user as $user) {
               return view('profiles.edit')->withUser(User::find($user->id));
            }
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'pen_name'=>'max:50',
            'about'=>['regex:/[a-zA-Z0-9_@.,\s!]*/','max:255'],
            'insta_link'=>'max:255',
            'facebook_link'=>'max:255',
            'google_link'=>'max:255',
            'twitter_link'=>'max:255',
            'featured_image'=>'sometimes|image'
        ]);

        $user=User::where('username',$id)->limit(1)->get();
        foreach ($user as $user) {
               $user=User::find($user->id);
               break;
        }
        $user->name=$request->name;
        $user->save();

        $Profile=$user->profile;
        $Profile->pen_name=$request->pen_name;
        $Profile->about=$request->about;
        $Profile->insta_link=$request->insta_link;
        $Profile->facebook_link=$request->facebook_link;
        $Profile->google_link=$request->google_link;
        $Profile->twitter_link=$request->twitter_link;

        if($request->hasFile('featured_image')){
            $image=$request->file('featured_image');
            $filename=time().'.'.$image->getClientOriginalExtension();

            $location=public_path('images/'.$filename);
            Image::make($image)->resize(200,200)->save($location);

            $Profile->profile_image_path='images/'.$filename;
        }

        $Profile->save();
        Session::flash('success','Profile has updated successfully.');
        return redirect()->route('profile.show',$id);
    }
}
