<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Blog;

class BlogController extends Controller
{
    
    public function index(){
    
        $blogs =  Blog::all();
        return view('blog.index',['blogs' => $blogs]);
    }

    public function create(){

        return view('blog.create');
    }

    public function store(Request $request)
    {
      $this->validate($request,[
      'title'=> 'required',
      'description' => 'required',
    ]);
    $blog = new blog;
    $blog->title = $request->title;
    $blog->description = $request->description;
    $blog->save();
    return redirect()->route('blog.index')->with('alert-success','Data Hasbeen Saved!');
    }

    public function show($id){
        //
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.edit',compact('blog'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
          'title'=> 'required',
          'description' => 'required',
      ]);
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        return redirect()->route('blog.index')->with('alert-success','Data Has been Saved!');
    }

    public function destroy($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blog.index')->with('alert-success','Data Has been Saved!');
    }
}
