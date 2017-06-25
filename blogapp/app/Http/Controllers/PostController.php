<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Session;
use App\Tag;
//use Purifier;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts= Post::orderBy('id','desc')->paginate(5);
       return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=Category::all();

        $cats=[];
        foreach ($categories as $category) {
            $cats[$category->id]=$category->name;
        }
        return view('posts.create')->withCategories($cats)->withTags(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required|max:255',
            'body'=>'required',
            'slug'=>'required|max:255|alpha_dash|min:5|unique:posts,slug',
            'category_id'=>'required|integer'
        ]);

        $post=new Post;
        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->body=$request->body;
        $dom = new Dom;
        $dom->load($request->body);
        $img = $dom->find('img')[0];
        if(is_null($img))
        	return redirect()->back()->withInput()->withErrors('Add atleast one image in the post.');
        else $post->display_image_path=$img->getAttribute('src');
        //$post->body=Purifier::clean($request->body);
        $post->category_id=$request->category_id;
        $post->author_id=Auth::id();

    
        $post->save();


        $post->tags()->sync($request->tags,false);

        Session::flash('success','This Post was succesfully saved!');
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return view('posts.show')->with('post',$post);
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::all();

        $cats=[];
        foreach ($categories as $category) {
            $cats[$category->id]=$category->name;
        }
        $post=Post::find($id);
        return view ('posts.edit')->with('post',$post)->withCategories($cats)->withTags(Tag::all());
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
        $post=Post::find($id);
        $this->validate($request,[
            'title'=>'required|max:255',
            'body'=>'required',
            'slug'=>$request->slug!=$post->slug?'required|max:255|alpha_dash|min:5|unique:posts,slug':"",
            'category_id'=>'required|integer'
        ]);

        
        $post->title=$request->title;
        $post->slug=$request->slug;
        //dd($request->body);
        $post->body=$request->body;
        $post->author_id=Auth::id();
        $dom = new Dom;
        $dom->load($request->body);
        $img = $dom->find('img')[0];
        if(is_null($img))
        	return redirect()->back()->withInput()->withErrors('Add atleast one image in the post.');
        else $post->display_image_path=$img->getAttribute('src');
        //$post->body=Purifier::clean($request->body);
        $post->category_id=$request->category_id;

        $post->save();

        if(isset($request->tags))
            $post->tags()->sync($request->tags);
        else $post->tags()->sync(array());
        Session::flash('success','This Post was succesfully Updated!');
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post=Post::find($id);
       $post->tags()->detach();
       $post->delete();

       Session::flash('success','Post has been succesfully deleted.');
       return redirect()->route('posts.index');
    }
}
