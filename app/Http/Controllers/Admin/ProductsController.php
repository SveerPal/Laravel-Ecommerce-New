<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Products_variation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')->get();  
        return view('admin.ecommerce.products.index',['products' => $products])->withTitle('Products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$products = DB::table('products')->get();
        $categories = DB::table('product_categories')->get();
        $brands = DB::table('product_brands')->get();
        $attributes = DB::table('product_attributes')->get();
        $attribute_values = DB::table('product_attribute_values')->get();
        return view('admin.ecommerce.products.create',['categories' => $categories,'brands'=>$brands,'attributes'=>$attributes])->withTitle('Create Product');
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
        if($request->input('product_type')=='Variation'){
            $validator = Validator::make($request->all(), [            
               
                'name'                      =>  'required',
                'product_type'              =>  'required',
                'price'                     =>  'required|numeric',
                'spacial_price'             =>  'numeric',
                'quantity'                  =>  'numeric',
                'image'                     =>  'required|mimes:jpg,png,jpeg,svg',
                'gallery.*'                 =>  'mimes:jpg,png,jpeg,svg',
                'slug'                      =>  'required|unique:products',            
                'sku'                       =>  'required|unique:products', 

                'attribute_id.*'            =>  'required',
                'attribute_variation_id.*'  =>  'required',
                'variation_price.*'         =>  'required|numeric',
                'variation_special_price.*' =>  'nullable|numeric',
                'variation_quantity.*'      =>  'nullable|numeric',
                'variation_image.*'         =>  'mimes:jpg,png,jpeg,svg',
                           
                
            ]);
        }else{
            $validator = Validator::make($request->all(), [            
           
                'name'                      =>  'required',
                'product_type'              =>  'required',
                'price'                     =>  'required|numeric',
                'spacial_price'             =>  'numeric',
                'quantity'                  =>  'numeric',
                'image'                     =>  'required|mimes:jpg,png,jpeg,svg',
                'gallery.*'                 =>  'mimes:jpg,png,jpeg,svg',
                'slug'                      =>  'required|unique:products',            
                'sku'                       =>  'required|unique:products',                 
            ]);
        }

        if ($validator->fails()) {
            //return back()->withErrors($validator)->withInput();
            return response()->json(array('status' => false,'errors' => $validator->getMessageBag()->toArray()));
        }
        
        if($request->hasFile('image')){ 
            $extension = $request->file('image')->extension();
            $image = $request->input('name').'_'.time().'.'.$extension;       
            $path = $request->file('image')->storeAs('public/uploads/ecommerce/products',$image);
        }


        $gallerydata= array();
        if($request->hasfile('gallery')) {
            foreach($request->file('gallery') as $file)
            {
                $extension = $file->extension();
                $gallery = $request->input('name').'_gal_'.rand().time().'.'.$extension;       
                $path = $file->storeAs('public/uploads/ecommerce/products',$gallery); 
                $gallerydata[] = $gallery;  
            }
        }

        $category_id="";
        if($request->input('category_id')!= null){
            $category_id= implode(',', $request->input('category_id'));
        }

        $products = new Product;

        $products->name = $request->input('name');
        $products->slug = str_slug($request->input('slug'));
        $products->product_type = $request->input('product_type');
        $products->sku = $request->input('sku');
        $products->image = $image;
        $products->gallery = implode(',',$gallerydata);        
        $products->category_id= $category_id;
        $products->brand_id= $request->input('brand_id');
        $products->price= $request->input('price');
        $products->special_price= $request->input('special_price');
        $products->quantity= $request->input('quantity');
        $products->weight= $request->input('weight');
        $products->short_description= $request->input('short_description');        
        $products->description= $request->input('description');
        $products->status= $request->input('status');
        $products->featured= $request->input('featured');        
        $products->meta_title = $request->input('meta_title');
        $products->meta_description= $request->input('meta_description');        
        $products->meta_keywords= $request->input('meta_keywords');
        $products->save();
        $products_id=$products->id;    


        if($products_id>0 &&  $request->input('product_type')=='Variation'){
           
           // dd($request->file('variation_image'));
           
            $products_variation = new Products_variation;
            for($v=0;$v<count($request->input('attribute_id'));$v++){
              
                $variation_image="";
                $varimg="";
                 
                if($request->hasFile('variation_image')){ 
                    if(!empty($request->file('variation_image')[$v])){
                        $extension = $request->file('variation_image')[$v]->extension();
                        $variation_image = $request->input('name').'_variation_'.rand().time().'.'.$extension;       
                        $path = $request->file('variation_image')[$v]->storeAs('public/uploads/ecommerce/products',$variation_image);
                    }
                }
                
                /*$products_variation->product_id = $products_id;
                $products_variation->attribute_id = $request->input('attribute_id')[$v];
                $products_variation->attribute_variation_id = $request->input('attribute_variation_id')[$v];
                $products_variation->variation_image = $variation_image;
                $products_variation->variation_quantity = $request->input('variation_quantity')[$v];
                $products_variation->variation_price = $request->input('variation_price')[$v];
                $products_variation->variation_special_price = $request->input('variation_special_price')[$v];
                $products_variation->variation_description = $request->input('variation_description')[$v];
                $products_variation->save();*/

                $data[] =[
                    'product_id' => $products_id,
                    'attribute_id' => $request->input('attribute_id')[$v],
                    'attribute_variation_id' => $request->input('attribute_variation_id')[$v],
                    'variation_image' => $variation_image,
                    'variation_quantity' => $request->input('variation_quantity')[$v],
                    'variation_price' => $request->input('variation_price')[$v],
                    'variation_special_price' => $request->input('variation_special_price')[$v],
                    'variation_description' => $request->input('variation_description')[$v],
                    
                   ];                 

                
                
               // dd($products_variation);
               
            }
            Products_variation::insert($data);
            
            if ($products_variation) {
                return response()->json(array('status' => true));
            } else {
                return response()->json(array('status' => flase,'errors' => $validator->getMessageBag()->toArray()));
            } 
        }else{ 
            if ($products) {
                return response()->json(array('status' => true));
            } else {
                return response()->json(array('status' => flase,'errors' => $validator->getMessageBag()->toArray()));
            }
            //return redirect('admin/products/')->with('success', 'New page has been created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,$id)
    {
        $blogs = DB::table('blogs')
        ->select('blogs.*',  \DB::raw('group_concat(DISTINCT(blog_categories.name)) as bcname'),\DB::raw('group_concat(DISTINCT(blog_tags.name)) as btname') )                           
        ->join("blog_categories",\DB::raw("FIND_IN_SET(blog_categories.id,blogs.blog_category_id)"),">",\DB::raw("'0'"))
        ->join("blog_tags",\DB::raw("FIND_IN_SET(blog_tags.id,blogs.blog_category_id)"),">",\DB::raw("'0'"))
        ->where('blogs.id',$id)                           
       /* ->groupBy('blog_categories.name')                           
        ->groupBy('blog_tags.name') */                          
        ->get(); 

        return view('admin.ecommerce.products.view',['blogs' => $blogs])->withTitle('Blogs Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {
        $products = DB::table('products')->where('id',$id)->get();
        //$products = DB::table('products')->whereNotNull('category_id')->get();
        //print_r($products);
        //die;
        $products_variations = DB::table('products_variations')->where('product_id',$id)->get();
        $categories = DB::table('product_categories')->get();
        $brands = DB::table('product_brands')->get();
        $attributes = DB::table('product_attributes')->get();
        $attribute_values = DB::table('product_attribute_values')->get();
        return view('admin.ecommerce.products.edit',['products'=>$products,'categories' => $categories,'brands'=>$brands,'attributes'=>$attributes,'attribute_values'=>$attribute_values,'products_variations'=>$products_variations])->withTitle('Edit Product');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {

        $image="";
        if($request->input('product_type')=='Variation'){
            $validator = Validator::make($request->all(), [            
               
                'name'                      =>  'required',
                'product_type'              =>  'required',
                'price'                     =>  'required|numeric',
                'spacial_price'             =>  'numeric',
                'quantity'                  =>  'numeric',
                'image'                     =>  'mimes:jpg,png,jpeg,svg',
                'gallery.*'                 =>  'mimes:jpg,png,jpeg,svg',
                'slug'                      =>  'required|unique:products,slug,'.$id,     
                'sku'                       =>  'required|unique:products,sku,'.$id, 

                'attribute_id.*'            =>  'required',
                'attribute_variation_id.*'  =>  'required',
                'variation_price.*'         =>  'required|numeric',
                'variation_special_price.*' =>  'nullable|numeric',
                'variation_quantity.*'      =>  'nullable|numeric',
                'variation_image.*'         =>  'mimes:jpg,png,jpeg,svg',
                           
                
            ]);
        }else{
            $validator = Validator::make($request->all(), [            
           
                'name'                      =>  'required',
                'product_type'              =>  'required',
                'price'                     =>  'required|numeric',
                'spacial_price'             =>  'numeric',
                'quantity'                  =>  'numeric',
                'image'                     =>  'mimes:jpg,png,jpeg,svg',
                'gallery.*'                 =>  'mimes:jpg,png,jpeg,svg',
                'slug'                      =>  'required|unique:products,slug,'.$id,            
                'sku'                       =>  'required|unique:products,sku,'.$id,                 
            ]);
        }

        if ($validator->fails()) {
            //return back()->withErrors($validator)->withInput();
            return response()->json(array('status' => false,'errors' => $validator->getMessageBag()->toArray()));
        }
       
        if($request->hasFile('image')){ 
            $extension = $request->file('image')->extension();
            $image = $request->input('name').'_'.time().'.'.$extension;       
            $path = $request->file('image')->storeAs('public/uploads/ecommerce/products',$image);
        }else{
            $image=$request->input('old_image');
        }


        $gallerydata= array();
        if($request->hasfile('gallery')) {
            foreach($request->file('gallery') as $file)
            {
                $extension = $file->extension();
                $gallery = $request->input('name').'_gal_'.rand().time().'.'.$extension;       
                $path = $file->storeAs('public/uploads/ecommerce/products',$gallery); 
                $gallerydata[] = $gallery;  
            }
            $gallerydata=implode(',',$gallerydata); 
        }else{
            $gallerydata=$request->input('old_gallery');
        }

        $category_id="";
        if($request->input('category_id')!= null){
            $category_id= implode(',', $request->input('category_id'));
        }

        $products = Product::find($id);

        $products->name = $request->input('name');
        $products->slug = str_slug($request->input('slug'));
        $products->product_type = $request->input('product_type');
        $products->sku = $request->input('sku');
        $products->image = $image;
        $products->gallery = $gallerydata;       
        $products->category_id= $category_id;
        $products->brand_id= $request->input('brand_id');
        $products->price= $request->input('price');
        $products->special_price= $request->input('special_price');
        $products->quantity= $request->input('quantity');
        $products->weight= $request->input('weight');
        $products->short_description= $request->input('short_description');        
        $products->description= $request->input('description');
        $products->status= $request->input('status');
        $products->featured= $request->input('featured');        
        $products->meta_title = $request->input('meta_title');
        $products->meta_description= $request->input('meta_description');        
        $products->meta_keywords= $request->input('meta_keywords');
        $products->update();
        
        

        if($request->input('product_type')=='Variation'){
           
           // dd($request->file('variation_image'));
           
            
            for($v=0;$v<count($request->input('attribute_id'));$v++){
                $products_variation="";
               
                $variation_image="";
                $varimg="";
                 
                if($request->hasFile('variation_image')){ 
                    if(!empty($request->file('variation_image')[$v])){
                        $extension = $request->file('variation_image')[$v]->extension();
                        $variation_image = $request->input('name').'_variation_'.rand().time().'.'.$extension;       
                        $path = $request->file('variation_image')[$v]->storeAs('public/uploads/ecommerce/products',$variation_image);
                    }
                }else{
                    $variation_image=$request->input('old_variation_image')[$v];
                }

                if(isset($request->input('product_variation_id')[$v])){
                    $products_variation = Products_variation::find($request->input('product_variation_id')[$v]);
                    
                    $products_variation->product_id = $id;
                    $products_variation->attribute_id = $request->input('attribute_id')[$v];
                    $products_variation->attribute_variation_id = $request->input('attribute_variation_id')[$v];
                    $products_variation->variation_image = $variation_image;
                    $products_variation->variation_quantity = $request->input('variation_quantity')[$v];
                    $products_variation->variation_price = $request->input('variation_price')[$v];
                    $products_variation->variation_special_price = $request->input('variation_special_price')[$v];
                    $products_variation->variation_description = $request->input('variation_description')[$v];
                    $products_variation->save();

                }elseif(!isset($request->input('product_variation_id')[$v])){
                    /*$data[] =[
                        'product_id' => $id,
                        'attribute_id' => $request->input('attribute_id')[$v],
                        'attribute_variation_id' => $request->input('attribute_variation_id')[$v],
                        'variation_image' => $variation_image,
                        'variation_quantity' => $request->input('variation_quantity')[$v],
                        'variation_price' => $request->input('variation_price')[$v],
                        'variation_special_price' => $request->input('variation_special_price')[$v],
                        'variation_description' => $request->input('variation_description')[$v],
                        
                       ];    */
                      
                    $products_variation = new Products_variation;
                    $products_variation->product_id = $id;
                    $products_variation->attribute_id = $request->input('attribute_id')[$v];
                    $products_variation->attribute_variation_id = $request->input('attribute_variation_id')[$v];
                    $products_variation->variation_image = $variation_image;
                    $products_variation->variation_quantity = $request->input('variation_quantity')[$v];
                    $products_variation->variation_price = $request->input('variation_price')[$v];
                    $products_variation->variation_special_price = $request->input('variation_special_price')[$v];
                    $products_variation->variation_description = $request->input('variation_description')[$v];
                    $products_variation->save();            
                }

                
                
               // dd($products_variation);
               
            }
            //die;Products_variation::insert($data);
            
            if ($products_variation) {
                return response()->json(array('status' => true));
            } else {
                return response()->json(array('status' => flase,'errors' => $validator->getMessageBag()->toArray()));
            } 
        }else{ 
            if ($products) {
                return response()->json(array('status' => true));
            } else {
                return response()->json(array('status' => flase,'errors' => $validator->getMessageBag()->toArray()));
            }
            //return redirect('admin/products/')->with('success', 'New page has been created.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id)
    {
        
        $products = DB::table('products')->where('id',$id)->delete();
        if($products){
            $products_variations = DB::table('products_variations')->where('product_id',$id)->delete();
            return response()->json(array('status' => true));
        }
    }
}
