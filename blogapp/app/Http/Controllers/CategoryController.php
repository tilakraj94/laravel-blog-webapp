<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Session;
class CategoryController extends Controller
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
        return view('categories.index')->withCategories(Category::where('user_id',Auth::id())->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          // Save a new category and then redirect back to index
        $this->validate($request, array(
            'name' => 'required|max:255'
            ));

        $category = new Category;

        $category_exists=Category::where('name','like',$request->name)->count();
        if($category_exists>0){
            return redirect()->route('categories.index')->withErrors('Category already exists.');
        }
        $category->name = $request->name;
        $category->user_id=Auth::id();
        $category->save();
         Session::flash('success','Category has been successfully saved!.');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::where('id',$id)->where('user_id',Auth::id())->get();
       
        if($category->count()==0)
            Session::flash('Errors','This action cannot be done.');
        else
            return view('categories.edit')->withCategory($category->find($id));
        return redirect()->route('categories.index');
        
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
        ]);

        $category=Category::where('id',$id)->where('user_id',Auth::id())->get();
       
        if($category->count()==0)
            Session::flash('Errors','This action cannot be done.');
        else
        {
            $category=$category->find($id);
            $category->name=$request->name;
            $category->save();
            Session::flash('success','Category name has been updated successfully!.');
        }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::where('id',$id)->where('user_id',Auth::id())->get();
       
        if($category->count()==0)
        {
            Session::flash('Errors','This action cannot be done.');
        }else{
            $category=$category->find($id);
            foreach ($category->posts as $post) {
            	$post->tags()->detach();
            }
            $category->posts()->delete();
            $category->delete();
        }

        return redirect()->route('categories.index');
;    }
}
