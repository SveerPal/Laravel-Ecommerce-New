<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productbrand;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class ProductbrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productbrands = DB::table('productbrands')->get();  
        return view('admin.ecommerce.brands.index',['productbrands' => $productbrands])->withTitle('Product Brands');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_product_brands = DB::table('productbrands')->get();
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
           
            'name'                      =>  'required|unique:productbrands',
            'slug'                      =>  'required|unique:productbrands',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/ecommerce/product_brands',$banner);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        $productbrand = new Productbrand;

        $productbrand->name = $request->input('name');
        $productbrand->slug = str_slug($request->input('slug'));
        $productbrand->parent = $request->input('parent');
        $productbrand->banner = $banner;
        $productbrand->alt = $request->input('alt');
        $productbrand->meta_title = $request->input('meta_title');
        $productbrand->meta_description= $request->input('meta_description');
        $productbrand->description= $request->input('description');
        $productbrand->save();
         
        return redirect('admin/product-brands/')->with('success', 'New Product Brands has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productbrand  $productbrand
     * @return \Illuminate\Http\Response
     */
    public function show(Productbrand $productbrand,$id)
    {
        $productbrands = DB::table('productbrands')->where('id',$id)->first();  
        return view('admin.ecommerce.brands.view',['productbrands' => $productbrands])->withTitle('Product Brand Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productbrand  $productbrand
     * @return \Illuminate\Http\Response
     */
    public function edit(Productbrand $productbrand,$id)
    {
        $productbrandsdtl = DB::table('productbrands')->where('id',$id)->get();        
        $parentproductbrands = DB::table('productbrands')->get();        
        return view('admin.ecommerce.brands.edit',['parentproductbrands' => $parentproductbrands,'productbrandsdtl'=>$productbrandsdtl])->withTitle('Edit Product Brand');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productbrand  $productbrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productbrand $productbrand,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:productbrands,name,'.$id,
            'slug'                      =>  'required|unique:productbrands,slug,'.$id,            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('banner')){ 

            $extension = $request->file('banner')->extension();
            $banner = time().'_'.$request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('banner')->storeAs('public/uploads/ecommerce/product_brands',$banner);
        }else{
            $banner=$request->input('banner_old');
        }
     
        $productbrand = Productbrand::find($id);

        $productbrand->name = $request->input('name');
        $productbrand->slug = str_slug($request->input('slug'));
        $productbrand->parent = $request->input('parent');
        $productbrand->banner = $banner;
        $productbrand->alt = $request->input('alt');
        $productbrand->meta_title = $request->input('meta_title');
        $productbrand->meta_description= $request->input('meta_description');
        $productbrand->description= $request->input('description');
        $productbrand->update();
         
        return redirect('admin/product-brands/')->with("success", $request->input('name')." Product Brand has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productbrand  $productbrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productbrand $productbrand,$id)
    {
        $productbrands = DB::table('productbrands')->where('id',$id)->delete(); 
        return redirect('admin/product-brands/')->with('success', 'Product Brand has been deleted.');
    }
}
