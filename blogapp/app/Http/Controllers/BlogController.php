<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Category;
use App\Tag;
use App;
use App\SearchPostView;
class BlogController extends Controller
{

    public function getIndex() {
        $posts = Post::paginate(5);
        return view('blog.index')->withPosts($posts);
    }
    
    public function getSingle($slug){
        $post=Post::where('slug','=',$slug)->first(); // get can be used as well but we used first cause it tells it to get the very first occurence , the only difference is that get we will get the result in an array while this will simply return one record

        return view('blog.single')->with('post',$post)->withCategories(Category::all())->withTags(Tag::all());
    }

    public function getQuery($id,$about){
        if(strtolower($about)=='tag'){
            $tag=Tag::find($id);
            return view('blog.query')->withQuery($tag->posts()->paginate(5));
        }else if(strtolower($about)=='category'){
            $category=Category::find($id);
            return view('blog.query')->withQuery($category->posts()->paginate(5));
        }else {
             abort(404);
        }
    }

    public function prefetchResults(){
        $searchResults=[];
        foreach (Category::all() as $category) {
            array_push($searchResults, $category->name);
        }
        foreach (Post::all() as $post) {
            array_push($searchResults, $post->name);
        }
        foreach (Tag::all() as $tag) {
            array_push($searchResults, $tag->name);
        }
        return response()->json($searchResults);
    }

    public function searchResults(Request $request){
        $search=$request->input('search');
        $post=SearchPostView::where(function($query) use($search){
            $query->where('title','LIKE',$search)->orWhere('category_name','LIKE',$search)->orWhere('tag_name','LIKE',$search);
        })->groupBy('id')->paginate(5);
        return view('blog.query')->withQuery($post);
    }

   
}
