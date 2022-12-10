<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use Session;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::latest()->get();
        return view('categories.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:categories']);

        $category = new Category($request->all());
        $category->save();

        Session::flash('message', 'Kategoria została dodana');

        if(isset($request->newadd)){
            return redirect('/categories/create');
        }else{
            return redirect('/categories');
        }
        
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        Session::flash('message', 'Kategoria została usunięta');

        return redirect('/categories');
    }
}
