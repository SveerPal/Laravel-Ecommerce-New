<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;

use Validator;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = DB::table('blogs')->get();  
        return view('admin.blogs.index',['blogs' => $blogs])->withTitle('Blog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_tags = DB::table('blog_tags')->get();
        $blog_categories = DB::table('blog_categories')->get();
        return view('admin.blogs.create',['blog_categories' => $blog_categories,'blog_tags'=>$blog_tags])->withTitle('Create Blog');
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
           
            'name'                      =>  'required',
            'slug'                      =>  'required|unique:blogs',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;       
            $path = $request->file('banner')->storeAs('public/uploads/blogs',$banner);
        }
        $blog_category_id="";
        $blog_tag_id="";
     
        if($request->input('blog_category_id')!= null){

             $blog_category_id= implode(',', $request->input('blog_category_id'));
        }
        if($request->input('blog_tag_id')!=null){

              $blog_tag_id = implode(',', $request->input('blog_tag_id'));
        }
                   

        $blogs = new Blog;

        $blogs->name = $request->input('name');
        $blogs->slug = str_slug($request->input('slug'));
        $blogs->banner = $banner;
        $blogs->alt = $request->input('alt');
        $blogs->meta_title = $request->input('meta_title');
        $blogs->meta_description= $request->input('meta_description');        
        $blogs->meta_keywords= $request->input('meta_keywords');
        $blogs->blog_category_id= $blog_category_id;
        $blogs->blog_tag_id= $blog_tag_id;
        $blogs->description= $request->input('description');
        $blogs->save();
         
        return redirect('admin/blogs/')->with('success', 'New page has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog,$id)
    {
        /*$blogs = DB::table('blogs')
                            ->select('blogs.*', 'blog_categories.name as bcname','blog_categories.id as bcid ', 'blog_tags.name as btname','blog_tags.id as btid')
                            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
                            ->join('blog_tags', 'blogs.blog_tag_id', '=', 'blog_tags.id')
                            ->whereIn('blog_categories.id'  ,[2, 3])
                            ->whereIn('blog_tags.id'  ,[2, 3])
                          //  ->where('blogs.id',$id)
                            ->get(); */
/*
                            $blogs = DB::table('blogs')
                            ->select('blogs.*', 'blog_categories.name .*')
                            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
                           // ->join('blog_tags', 'blogs.blog_tag_id', '=', 'blog_tags.id')
                           // ->whereIn('blog_categories.id'  ,[2, 3])
                            ->whereRaw("FIND_IN_SET(blog_categories.id,[2, 3])")
                          //  ->whereIn('blog_tags.id'  ,[2, 3])
                            ->where('blogs.id',$id)
                            ->get(); 
*/
                      $search = 1;
                        $blogs = \DB::table("blogs")
                            ->select("blogs.*")
                            ->whereRaw("find_in_set('".$search."',blogs.blog_category_id)")
                            ->where('blogs.id',$id)
                            ->get();
                        dd( $blogs); die;   

        return view('admin.blogs.view',['blogs' => $blogs])->withTitle('Blogs Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog,$id)
    {
        $blogsdetail = DB::table('blogs')->where('id',$id)->get();
        return view('admin.blogs.edit',['blogsdetail'=>$blogsdetail])->withTitle('Edit Blogs');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required',
            'slug'                      =>  'required|unique:blogs,slug,'.$id,            
            
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
        
        $blogs = Blog::find($id);

        $blogs->name = $request->input('name');
        $blogs->slug = str_slug($request->input('slug'));
        $blogs->banner = $banner;
        $blogs->alt = $request->input('alt');
        $blogs->meta_title = $request->input('meta_title');
        $blogs->meta_description= $request->input('meta_description');     
        $blogs->meta_keywords= $request->input('meta_keywords');
        $blogs->blog_category_id= $request->input('blog_category_id');
        $blogs->blog_tag_id= $request->input('blog_tag_id');
        $blogs->description= $request->input('description');
        $blogs->update();
         
        return redirect('admin/blogs/')->with("success", $request->input('name')." Blog has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog,$id)
    {
        $blogs = DB::table('blogs')->where('id',$id)->delete();
        return redirect('admin/blogs/')->with('success', 'Blog has been deleted.');
    }
}
