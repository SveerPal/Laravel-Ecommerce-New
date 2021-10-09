<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;
class ProductBrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_brands = DB::table('product_brands')->get();  
        return view('admin.ecommerce.brands.index',['product_brands' => $product_brands])->withTitle('Product Brands');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_product_brands = DB::table('product_brands')->get();
        return view('admin.ecommerce.brands.create',['parent_product_brands' => $parent_product_brands])->withTitle('Create Product Brands');
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
           
            'name'                      =>  'required|unique:product_brands',
            'slug'                      =>  'required|unique:product_brands',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/ecommerce/product_brand',$banner);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        $productbrand = new ProductBrand;

        $productbrand->name = $request->input('name');
        $productbrand->slug = str_slug($request->input('slug'));
        $productbrand->parent_id = $request->input('parent');
        $productbrand->banner = $banner;
        $productbrand->alt = $request->input('alt');
        $productbrand->meta_title = $request->input('meta_title');
        $productbrand->meta_description= $request->input('meta_description');
        $productbrand->meta_keywords= $request->input('meta_keywords');
        $productbrand->description= $request->input('description');
        $productbrand->save();
         
        return redirect('admin/product-brands/')->with('success', 'New Product Brands has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBrand $productBrand,$id)
    {
        $product_brands = DB::table('product_brands as brand')
                                ->select('brand.*','parentbrand.name as parentbrandname')
                                ->leftjoin('product_brands as parentbrand','brand.parent_id','=','parentbrand.id')
                                ->where('brand.id',$id)
                                ->first();  
        return view('admin.ecommerce.brands.view',['product_brands' => $product_brands])->withTitle('Product Brand Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBrand $productBrand,$id)
    {
        $product_brands = DB::table('product_brands')->where('id',$id)->get();        
        $parent_product_brands = DB::table('product_brands')->whereNotIn('id',[$id])->get();        
        return view('admin.ecommerce.brands.edit',['parent_product_brands' => $parent_product_brands,'product_brands'=>$product_brands])->withTitle('Edit Product Brand');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBrand $productBrand,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:product_brands,name,'.$id,
            'slug'                      =>  'required|unique:product_brands,slug,'.$id,            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/ecommerce/product_brand',$banner);
        }else{
            $banner=$request->input('banner_old');
        }
     
        $productbrand = ProductBrand::find($id);

        $productbrand->name = $request->input('name');
        $productbrand->slug = str_slug($request->input('slug'));
        $productbrand->parent_id = $request->input('parent');
        $productbrand->banner = $banner;
        $productbrand->alt = $request->input('alt');
        $productbrand->meta_title = $request->input('meta_title');
        $productbrand->meta_description= $request->input('meta_description');
        $productbrand->meta_keywords= $request->input('meta_keywords');
        $productbrand->description= $request->input('description');
        $productbrand->update();
         
        return redirect('admin/product-brands/')->with("success", $request->input('name')." Product Brand has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBrand $productBrand,$id)
    {
        $productbrands = DB::table('product_brands')->where('id',$id)->delete(); 
        return redirect('admin/product-brands/')->with('success', 'Product Brand has been deleted.');
    }
}
