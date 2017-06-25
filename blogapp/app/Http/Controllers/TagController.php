<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
         $this->middleware('auth');
    }

    public function index()
    {
        return view('tags.index')->withTags(Tag::where('user_id',Auth::id())->get());
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
           'name'=>'required|max:255'
         ]);

         $tag=new Tag();
         $tag->name=$request->name;
         $tag->user_id=Auth::id();
         $tag->save();

         Session::flash('success','Tag has been successfully saved!.');
         return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tags.show')->withTag(Tag::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('tags.edit')->withTag(Tag::find($id));
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

        $tag=Tag::find($id);
        $this->validate($request,[
            'name'=>'required|max:255',
        ]);

        $tag->name=$request->name;
        $tag->save();
        Session::flash('success','Tag name has been updated successfully!.');

        return redirect()->route('tags.show',$tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag=Tag::find($id);

        $tag->posts()->detach();
        $tag->delete();
        Session::flash('success','Tag has been successfully deleted!.');
        return redirect()->route('tags.index');
    }
}
