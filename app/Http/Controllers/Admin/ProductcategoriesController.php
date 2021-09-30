<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class ProductcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productcategories = DB::table('productcategories')->get();  
        return view('admin.ecommerce.categories.index',['productcategories' => $productcategories])->withTitle('Product Categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $parent_product_categories = DB::table('productcategories')->get();
        return view('admin.ecommerce.categories.create',['parent_product_categories' => $parent_product_categories])->withTitle('Create Product Category');
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
           
            'name'                      =>  'required|unique:productcategories',
            'slug'                      =>  'required|unique:productcategories',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/ecommerce/product_category',$banner);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        $productcategory = new Productcategory;

        $productcategory->name = $request->input('name');
        $productcategory->slug = str_slug($request->input('slug'));
        $productcategory->parent = $request->input('parent');
        $productcategory->banner = $banner;
        $productcategory->alt = $request->input('alt');
        $productcategory->meta_title = $request->input('meta_title');
        $productcategory->meta_description= $request->input('meta_description');
        $productcategory->description= $request->input('description');
        $productcategory->save();
         
        return redirect('admin/product-categories/')->with('success', 'New Product Category has been created.');
        //return back()->with('success', 'New Page has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Productcategory $productcategory,$id)
    {
        $productcategories = DB::table('productcategories')->where('id',$id)->first();  
        return view('admin.ecommerce.categories.view',['productcategories' => $productcategories])->withTitle('Product Category Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Productcategory $productcategory,$id)
    {
        $productcategoriesdtl = DB::table('productcategories')->where('id',$id)->get();        
        $parentproductcategories = DB::table('productcategories')->get();        
        return view('admin.ecommerce.categories.edit',['parentproductcategories' => $parentproductcategories,'productcategoriesdtl'=>$productcategoriesdtl])->withTitle('Edit Product Category');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productcategory $productcategory ,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:productcategories,name,'.$id,
            'slug'                      =>  'required|unique:productcategories,slug,'.$id,            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/ecommerce/product_category',$banner);
        }else{
            $banner=$request->input('banner_old');
        }
     
        $productcategory = Productcategory::find($id);

        $productcategory->name = $request->input('name');
        $productcategory->slug = str_slug($request->input('slug'));
        $productcategory->parent = $request->input('parent');
        $productcategory->banner = $banner;
        $productcategory->alt = $request->input('alt');
        $productcategory->meta_title = $request->input('meta_title');
        $productcategory->meta_description= $request->input('meta_description');
        $productcategory->description= $request->input('description');
        $productcategory->update();
         
        return redirect('admin/product-categories/')->with("success", $request->input('name')." Product Category has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productcategory $productcategory,$id)
    {
        $productcategories = DB::table('productcategories')->where('id',$id)->delete(); 
       // $user = User::where('id', $id)->firstorfail()->delete();
        return redirect('admin/product-categories/')->with('success', 'Product Category has been deleted.');
    }
}
