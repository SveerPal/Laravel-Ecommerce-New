<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;

use Validator;

class Blog_CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_categories = DB::table('blog_categories')->get();  
        return view('admin.blogs.categories.index',['blog_categories' => $blog_categories])->withTitle('Blog Categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = DB::table('blog_categories')->get();
        return view('admin.blogs.categories.create',['parentBlog_categories' => $blog_categories])->withTitle('Create Blog Category');
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
           
            'name'                      =>  'required|unique:blog_categories',
            'slug'                      =>  'required|unique:blog_categories',            
            
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
        $blog_categories = new Blog_Category;

        $blog_categories->name = $request->input('name');
        $blog_categories->slug = str_slug($request->input('slug'));
        $blog_categories->parent_id = $request->input('parent');
        $blog_categories->banner = $banner;
        $blog_categories->alt = $request->input('alt');
        $blog_categories->meta_title = $request->input('meta_title');
        $blog_categories->meta_description= $request->input('meta_description');
        $blog_categories->meta_keywords= $request->input('meta_keywords');
        $blog_categories->description= $request->input('description');
        $blog_categories->save();
         
        return redirect('admin/blog-categories/')->with('success', 'New Blog Category has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog_Category  $blog_Category
     * @return \Illuminate\Http\Response
     */
    public function show(Blog_Category $blog_Category,$id)
    {
        $blog_categories = DB::table('blog_categories')->where('id',$id)->first();  
        return view('admin.blogs.categories.view',['blog_categories' => $blog_categories])->withTitle('Blog Category Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog_Category  $blog_Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog_Category $blog_Category,$id)
    {
        $blog_categoriesdetail = DB::table('blog_categories')->where('id',$id)->get();        
        $parentBlog_categories = DB::table('blog_categories')->whereNotIn('id', [$id])->get();        
        return view('admin.blogs.categories.edit',['parentBlog_categories' => $parentBlog_categories,'blog_categoriesdetail'=>$blog_categoriesdetail])->withTitle('Edit Blog Category');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog_Category  $blog_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog_Category $blog_Category,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:blog_categories,name,'.$id,
            'slug'                      =>  'required|unique:blog_categories,slug,'.$id,            
            
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
        //$page = new Page;
        $blog_categories = Blog_Category::find($id);

        $blog_categories->name = $request->input('name');
        $blog_categories->slug = str_slug($request->input('slug'));
        $blog_categories->parent_id = $request->input('parent');
        $blog_categories->banner = $banner;
        $blog_categories->alt = $request->input('alt');
        $blog_categories->meta_title = $request->input('meta_title');
        $blog_categories->meta_description= $request->input('meta_description');               
        $blog_categories->meta_keywords= $request->input('meta_keywords');
        $blog_categories->description= $request->input('description');
        $blog_categories->update();
         
        return redirect('admin/blog-categories/')->with("success", $request->input('name')." Blog Category has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog_Category  $blog_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog_Category $blog_Category,$id)
    {
        $blog_categories = DB::table('blog_categories')->where('id',$id)->delete(); 
        return redirect('admin/blog-categories/')->with('success', 'Blog Category has been deleted.');
    }
}
