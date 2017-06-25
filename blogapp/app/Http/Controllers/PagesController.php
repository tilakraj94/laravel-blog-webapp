<?php

namespace App\Http\Controllers;
use Session;
use Mail;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function getIndex(){
        $posts=Post::whereNotNull('display_image_path')->orderBy('created_at','desc')->limit(6)->get();
    	return view('pages.welcome')->with('posts',$posts)->withCategories(Category::all())->withTags(Tag::all());
    }

    public function getContact(){
    	return view('pages.contact');
    }


    public function postContact(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|max:',
            'subject'=>'min:4',
            'message'=>'required|min:10'
        ]);


        $data=array(
        'email'=>$request->email,
        'subject'=>$request->subject,
        'bodyMessage'=>$request->message,
        'name'=>$request->name,
        );

        Mail::send('emails.contact',$data,function($message) use ($data){
            $message->from($data['email']);
            $message->subject('Contact form notification');
            $message->to('support@foodquo.com');
        });


        Session::flash('success','Your Query has been noted');
        return redirect()->route('home');
    }

     public function getAbout(){
    	return view('pages.about');
    }
}
