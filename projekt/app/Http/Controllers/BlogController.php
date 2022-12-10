<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comments;
use App\BlogConfig;

use App\User;
use Auth;
use Session;
use Hash;
use Image;

class BlogController extends Controller
{

    public function index()
    {
        $search = isset($_GET['search']) ? \Request::get('search') : null;
        $config = BlogConfig::firstOrFail(); 

        if ( !isset($search) ) {
         
            $posts = Post::latest()->orderBY('created_at', 'DESC')->paginate($config->pagination);
        } else {
            $posts = Post::latest()->where('title', 'like', '%' . $search . '%')->paginate($config->pagination);
        }
        // Return view
        return view('templates.myappblog.index', compact('posts', 'config'));
    }


    public function show($id)
    {
        $config = BlogConfig::firstOrFail();
        $post = Post::findOrFail($id);
        if($post->publish != 0){
            return view('templates.myappblog.show', compact('post', 'config'));
        }else{
            return redirect('/');
        }
    }

    public function profile(){
        $user = Auth::user();
        return view('templates.myAppBlog.profile', compact('user'));
    }

    public function updateAvatar(Request $request){
        $user = Auth::user();

    	$this->validate($request, ['avatar' => 'required|mimes:jpeg,png,jpg|max:2048']);

        if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
            $filename = md5(uniqid(rand(), true)) . "." . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

            $old_avatar = $user->avatar; 
    		$user->avatar = $filename;
    		$user->save();

   
            if($old_avatar != "default.png"){
                if(file_exists(public_path('/uploads/avatars/' . $old_avatar))){
                    unlink(public_path('/uploads/avatars/' . $old_avatar)); 
                }
            }
            
            Session::flash('message', 'Avatar został zmieniony');
    	}
    	return redirect('/profile');
    }

    public function updatePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
 
        $user = Auth::user();
 
        if(Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
 
            $request->session()->flash('message', 'Hasło zostało zmienione');
            return redirect('/profile');
        }
        $request->session()->flash('message_error', 'Błąd, Hasło nie zostało zmienione');
        return redirect('/profile');
    }
}
