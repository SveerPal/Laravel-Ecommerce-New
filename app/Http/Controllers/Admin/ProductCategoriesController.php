<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;
class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_categories = DB::table('product_categories')->get();  
        return view('admin.ecommerce.categories.index',['product_categories' => $product_categories])->withTitle('Product Categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_product_categories = DB::table('product_categories')->get();
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
           
            'name'                      =>  'required|unique:product_categories',
            'slug'                      =>  'required|unique:product_categories',            
            
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
        $productcategory = new ProductCategory;

        $productcategory->name = $request->input('name');
        $productcategory->slug = str_slug($request->input('slug'));
        $productcategory->parent_id = $request->input('parent');
        $productcategory->banner = $banner;
        $productcategory->alt = $request->input('alt');
        $productcategory->meta_title = $request->input('meta_title');
        $productcategory->meta_description= $request->input('meta_description');
        $productcategory->meta_keywords= $request->input('meta_keywords');
        $productcategory->description= $request->input('description');
        $productcategory->save();
         
        return redirect('admin/product-categories/')->with('success', 'New Product Category has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory,$id)
    {
        $product_categories = DB::table('product_categories as cat')
                                        ->select('cat.*','parentcat.name as parentcatname')
                                        ->leftjoin('product_categories as parentcat','cat.parent_id','=','parentcat.id')
                                        ->where('cat.id',$id)
                                        ->first();

        return view('admin.ecommerce.categories.view',['product_categories' => $product_categories])->withTitle('Product Category Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory,$id)
    {
        $product_categories = DB::table('product_categories')->where('id',$id)->get();        
        $parent_product_categories = DB::table('product_categories')->whereNotIn('id',[$id])->get();        
        return view('admin.ecommerce.categories.edit',['parent_product_categories' => $parent_product_categories,'product_categories'=>$product_categories])->withTitle('Edit Product Category');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:product_categories,name,'.$id,
            'slug'                      =>  'required|unique:product_categories,slug,'.$id,            
            
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
     
        $productcategory = ProductCategory::find($id);

        $productcategory->name = $request->input('name');
        $productcategory->slug = str_slug($request->input('slug'));
        $productcategory->parent_id = $request->input('parent');
        $productcategory->banner = $banner;
        $productcategory->alt = $request->input('alt');
        $productcategory->meta_title = $request->input('meta_title');
        $productcategory->meta_description= $request->input('meta_description');
        $productcategory->meta_keywords= $request->input('meta_keywords');
        $productcategory->description= $request->input('description');
        $productcategory->update();
         
        return redirect('admin/product-categories/')->with("success", $request->input('name')." Product Category has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory,$id)
    {
        $productcategories = DB::table('product_categories')->where('id',$id)->delete(); 
       // $user = User::where('id', $id)->firstorfail()->delete();
        return redirect('admin/product-categories/')->with('success', 'Product Category has been deleted.');
    }
}
