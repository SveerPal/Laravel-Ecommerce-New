<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog_Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;

use Validator;
class Blog_TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_tags = DB::table('blog_tags')->get();  
        return view('admin.blogs.tags.index',['blog_tags' => $blog_tags])->withTitle('Blog Tags');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_tags = DB::table('blog_tags')->get();
        return view('admin.blogs.tags.create',['parentBlog_tags' => $blog_tags])->withTitle('Create Blog Tag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner="";
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:blog_tags',
            'slug'                      =>  'required|unique:blog_tags',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/blogs',$banner);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        $blog_tags = new Blog_tag;

        $blog_tags->name = $request->input('name');
        $blog_tags->slug = str_slug($request->input('slug'));
        $blog_tags->banner = $banner;
        $blog_tags->alt = $request->input('alt');
        $blog_tags->meta_title = $request->input('meta_title');
        $blog_tags->meta_description= $request->input('meta_description');       
        $blog_tags->meta_keywords= $request->input('meta_keywords');
        $blog_tags->description= $request->input('description');
        $blog_tags->save();
         
        return redirect('admin/blog-tags/')->with('success', 'New Blog Tag has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog_Tag  $blog_Tag
     * @return \Illuminate\Http\Response
     */
    public function show(Blog_Tag $blog_Tag,$id)
    {
        $blog_tags = DB::table('blog_tags')->where('id',$id)->first();  
        return view('admin.blogs.tags.view',['blog_tags' => $blog_tags])->withTitle('Blog Tag Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog_Tag  $blog_Tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog_Tag $blog_Tag,$id)
    {
        $blog_tagsdetail = DB::table('blog_tags')->where('id',$id)->get();      
        return view('admin.blogs.tags.edit',['blog_tagsdetail'=>$blog_tagsdetail])->withTitle('Edit Blog Tag');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog_Tag  $blog_Tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog_Tag $blog_Tag,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:blog_tags,name,'.$id,
            'slug'                      =>  'required|unique:blog_tags,slug,'.$id,            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/blogs',$banner);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }else{
            $banner=$request->input('banner_old');
        }
       
        $blog_tags = Blog_tag::find($id);

        $blog_tags->name = $request->input('name');
        $blog_tags->slug = str_slug($request->input('slug'));
        $blog_tags->banner = $banner;
        $blog_tags->alt = $request->input('alt');
        $blog_tags->meta_title = $request->input('meta_title');
        $blog_tags->meta_description= $request->input('meta_description');
        $blog_tags->meta_keywords= $request->input('meta_keywords');
        $blog_tags->description= $request->input('description');
        $blog_tags->update();
         
        return redirect('admin/blog-tags/')->with("success", $request->input('name')." Blog Tag has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog_Tag  $blog_Tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog_Tag $blog_Tag,$id)
    {
        $blog_tags = DB::table('blog_tags')->where('id',$id)->delete(); 
        return redirect('admin/blog-tags/')->with('success', 'Blog Tag has been deleted.');
    }
}
