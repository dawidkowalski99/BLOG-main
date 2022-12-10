<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;

use Session;
use Auth;
use Image;

use PDF;

class PostsController extends Controller
{

    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
            // gdy user jest adminem
            $posts = Post::withTrashed()->orderBY('created_at', 'DESC')->paginate(5);
        }else{
            $posts = Post::where('user_id', Auth::user()->id)->orderBY('created_at', 'DESC')->paginate(5);
        }
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::pluck('name','id');
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {   
        $post = new Post($request->all());
        $post->user_id = Auth::user()->id;

        $this->validate($request, ['title' => 'required', 'contents' => 'required', 'image' => 'mimes:jpeg,png,jpg|max:2048']);

        if(!isset($request->publish)){
            $request->request->add(['publish' => 0]);
        }

        if($request->hasFile('image')){
    		$image = $request->file('image');
            $filename = md5(uniqid(rand(), true)) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 300)->save( public_path('/uploads/posts/' . $filename )); // Upload and resize image

    		$post->image = $filename;
    	}else{
            $post->image = 'default.png';
        }

    
        $post->save($request->all());


        $categoryIds = $request->input('CategoryList');
        $post->categories()->attach($categoryIds);

        Session::flash('message', 'Nowy wpis został dodany.');
        return redirect('/posts');              
    }

    public function show($id)
    {
        if(Auth::user()->hasRole('Admin')){
            $post = Post::withTrashed()->findOrFail($id);
        }else{
            $post = Post::where('user_id', Auth::user()->id)->findOrFail($id);
        }

        return view('posts.show', compact('post'));
    }

    public function pdf($id){
        $post = Post::findOrFail($id);
        $pdf = PDF::loadView('posts.pdf', ['post' => $post]);
        return $pdf->download($post->title . '.pdf');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id');
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['title' => 'required', 'contents' => 'required', 'image' => 'mimes:jpeg,png,jpg|max:2048']);


        $post = Post::findOrFail($id);
        $old_image = $post->image; 
        if(!isset($request->publish)){
            $request->request->add(['publish' => 0]);
        }

        /*dodawanie postu */

        $post->update($request->all());

        if($request->hasFile('image')){
    		$image = $request->file('image');
            $filename = md5(uniqid(rand(), true)) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 300)->save( public_path('/uploads/posts/' . $filename )); // Upload and resize image

    		$post->image = $filename;
    		$post->save();

            // usuwanie zdjęcia
            if($old_image != "default.png"){
                if(file_exists(public_path('/uploads/posts/' . $old_image))){
                    unlink(public_path('/uploads/posts/' . $old_image)); // Delete post image
                }
            }
    	}

        /* zmienianie kategorii */
        $post->categories()->sync($request->input('CategoryList'));

        Session::flash('message', 'Treść wpisu został zmieniona.');
        return redirect('/posts');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash('message', 'Post został usunięty');

        return redirect('/posts');
    }
}
