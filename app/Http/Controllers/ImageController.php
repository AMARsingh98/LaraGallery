<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Album;

class ImageController extends Controller
{

    public function __construct(){
        $this->middleware('admin',['only'=>['destroy']]);
        
    }

    public function index(){
        $images = Image::get(); 
        return view('home', compact('images'));
    }

    public function album(){
        $albums = Album::with('Images')->get();
        return  view('welcome',compact('albums'));
    }

    public function albumImage(Request $request){
        $this->validate($request,[
            'image' => 'required'
          ]);
          $albumId=request('id');
        if($request->hasfile('image')){
                $file = $request->file('image');
                $path = $file->store('uploads','public');
             Album::where('id',$albumId)->update([
                'image'=>$path,
            ]);
            
        }
         return redirect()
        ->back()
        ->with('success', 'Album Image Added successfully!');

    }

    public function show($id){

        $albums= Album::findOrFail($id);
        return view('gallery', compact('albums'));
    }

    public function destroy(){
        $id = request('id');
        $image = Image::findOrFail($id);
        $filename= $image->name;
        $image->delete();
        \Storage::delete('public/'.$filename);
        return redirect()
        ->back()
        ->with('success', 'Image deleted successfully!');
    }

    public function addImage(Request $request){
        $albumId=request('id');
        if($request->hasfile('image')){
            foreach($request->file('image') as $image){
                $path = $image->store('uploads','public');
            Image::create([
                'name'=>$path,
                'album_id'=>$albumId
            ]);
            }
        }
         return redirect()
        ->back()
        ->with('success', 'Images Added successfully!');

    }

    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
          'name' => 'required|min:3|max:50',
          'image' => 'required'
        ]);

        $album = Album::create(['name'=>$request->get('name')]);
        if($request->hasfile('image')){
            foreach($request->file('image') as $image){
                $path = $image->store('uploads','public');
            Image::create([
                'name'=>$path,
                'album_id'=>$album->id
            ]);
            }
        }
         return redirect('/')
        ->with('success', 'Album Created successfully!');
    }

    
   }
    


