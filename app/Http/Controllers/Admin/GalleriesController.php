<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = DB::table('galleries')->get();  
        return view('admin.galleries.index',['galleries' => $galleries])->withTitle('Galleries');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.galleries.create')->withTitle('Create Gallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $image="";
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required',
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 

            $extension = $request->file('image')->extension();
            $image = $request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('image')->storeAs('public/uploads/galleries',$image);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        $gallery = new Gallery;

        $gallery->name = $request->input('name');
        $gallery->link = $request->input('link');
        $gallery->image = $image;
        $gallery->alt = $request->input('alt');
        $gallery->save();
         
        return redirect('admin/galleries/')->with('success', 'New file has been uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery,$id)
    {
        $galleriesdtls = DB::table('galleries')->where('id',$id)->get();        
             
        return view('admin.galleries.edit',['galleriesdtls'=>$galleriesdtls])->withTitle('Edit Gallery');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required',
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 

            $extension = $request->file('image')->extension();
            $image = $request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('image')->storeAs('public/uploads/galleries',$image);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        else{
            $image=$request->input('image_old');
        }
        $gallery = Gallery::find($id);;

        $gallery->name = $request->input('name');
        $gallery->link = $request->input('link');
        $gallery->image = $image;
        $gallery->alt = $request->input('alt');
        $gallery->update();
         
        return redirect('admin/galleries/')->with("success", $request->input('name')." Galleries has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery,$id)
    {
        $galleries = DB::table('galleries')->where('id',$id)->delete(); 
        return redirect('admin/galleries/')->with('success', 'Gallery has been deleted.');
    }
}
