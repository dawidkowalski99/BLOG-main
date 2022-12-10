<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BlogConfig;

use Session;
use Image;

class BlogConfigController extends Controller
{

    public function index()
    {
        return view('blogconfig.index');
    }

    public function text(){
        $config = BlogConfig::firstOrFail(); 
        $text = $config->text; 
        return view('blogconfig.text', compact('text'));
    }

    public function updateText(Request $request){
        $this->validate($request, ['text' => 'required|max:20']);

        $config = BlogConfig::firstOrFail(); 
        $config->text = $request->text;
        $config->update();

        Session::flash('message', 'Tekst powitalny został zmieniony');

        return redirect('/blog-config/text');
    }

    public function pagination(){
        $config = BlogConfig::firstOrFail();
        $pagination = $config->pagination; 
        return view('blogconfig.pagination', compact('pagination'));
    }

    public function updatePagination(Request $request){

        $this->validate($request, [
        'pagination' => 'required|numeric'
        ]);

        $config = BlogConfig::firstOrFail(); 

        $config->pagination = $request->pagination;
        $config->update();

        Session::flash('message', 'Poaginacja została zmieniona');

        return redirect('/blog-config/pagination');
    }

    public function image(){
        $config = BlogConfig::firstOrFail(); 
        $image = $config->image; 
        return view('blogconfig.image', compact('image'));
    }

    public function updateImage(Request $request){

         $this->validate($request, ['image' => 'mimes:jpeg,png,jpg|max:2048']);

        $config = BlogConfig::firstOrFail(); 
        $old_image = $config->image; 

        if($request->hasFile('image')){
    		$image = $request->file('image');
            $filename = md5(uniqid(rand(), true)) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 700)->save( public_path('/myappblog/img/' . $filename )); 

    		$config->image = $filename;
    	}else{
            $config->image = 'default.jpg';
        }

        $config->update();


        if($old_image != "default.png") 
        {
            if(file_exists(public_path('/myappblog/img/' . $old_image))){
                unlink(public_path('/myappblog/img/' . $old_image));
            }           
        }


        Session::flash('message', 'Obrazek w tle został zmieniony');

        return redirect('/blog-config/image');
    }
}
