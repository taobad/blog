<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Session;
use Purifier;
use Image;
use Storage;

use App\Http\Requests;

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
        $posts = Post::orderBy('id','desc')-> paginate(5);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request,[
            'title' => 'required|max:255',
            'body' => 'required',
            'slug' => 'required|max:255|min:5|alpha_dash|unique:posts,slug',
            'category_id' => 'required|integer',
            'featured_image' => 'sometimes | image'
        ]);
        //$tags = new Tag;
        $post = new Post;
        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;

        //save our image
        if($request->hasFile('featured_image')){
          $image = $request->file('featured_image');
          $filename = time() . '.' .$image->getClientOriginalExtension();
          $location = public_path('images/'.$filename);
          Image::make($image)->resize(800,400)->save($location);

          $post->image = $filename;
        }

        $post->save();

        if(isset($request->tags)) {
            $post->tags()->sync($request->tags, false);
        } else{
            $post->tags()->sync(array());
        }

        Session::flash('success',' Blog post successfully saved!');
        //or
        //session()->flash('success','blog post successfully saved!');
        return redirect()->route('posts.show',$post->id);//->withTags($tags);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category){
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = [];
        foreach ($tags as $tag){
            $tags2[$tag->id] = $tag->name;
        }
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
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
        $post =  Post::find($id);

            $this->validate($request,[
                'title' => 'required|max:255',
                'body' => 'required',
                'slug' => "required|max:255|min:5|alpha_dash|unique:posts,slug,$id",
                'category_id' => 'required|integer',
                'featured_image' => 'sometimes | image'
            ]);



        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;

        if($request->hasFile('featured_image')){
          //Add new photo
          $image = $request->file('featured_image');
          $filename = time() . '.' .$image->getClientOriginalExtension();
          $location = public_path('images/'.$filename);
          Image::make($image)->resize(800,400)->save($location);

          $oldFilename = $post->image;
          //update the database
          $post->image = $filename;

          //Delete the old photo
          Storage::delete($oldFilename);

        }

        $post->save();
        if(isset($request->tags)) {
            $post->tags()->sync($request->tags, true);
        } else{
            $post->tags()->sync(array());
        }
        Session::flash('success',' Blog post successfully edited!');
        //or
        //session()->flash('success','blog post successfully saved!');
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
        $post =  Post::find($id);
        $post->tags()->detach();

        Storage::delete($post->image);

        $post->delete();

        Session::flash('success',' Post deleted!');
        return redirect()->route('posts.index');
    }
}
