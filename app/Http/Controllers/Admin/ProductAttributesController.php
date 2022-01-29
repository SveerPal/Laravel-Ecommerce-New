<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

use App\Models\ProductAttributeValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class ProductAttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productattributes = DB::table('product_attributes')->get();  
        return view('admin.ecommerce.attributes.index',['productattributes' => $productattributes])->withTitle('Product Attributes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ecommerce.attributes.create')->withTitle('Create Product Attribute');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:product_attributes',
            'code'                      =>  'required|unique:product_attributes',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $productattribute = new ProductAttribute;

        $productattribute->name = $request->input('name');
        $productattribute->code = str_slug($request->input('code'));
        $productattribute->save();
         
        return redirect('admin/product-attributes/')->with('success', 'New Product Attributes has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAttribute $productAttribute,$id)
    {
        $productattributes = DB::table('product_attributes')->where('id',$id)->first();  
        $productattributesvalues = DB::table('product_attribute_values')->where('product_attribute_id',$id)->orderBy('id','desc')->get();  
        return view('admin.ecommerce.attributes.view',['productattributes' => $productattributes,'productattributesvalues'=>$productattributesvalues])->withTitle('Product Attribute Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAttribute $productAttribute,$id)
    {
        $productattributedtl = DB::table('product_attributes')->where('id',$id)->get(); 
        return view('admin.ecommerce.attributes.edit',['productattributedtl'=>$productattributedtl])->withTitle('Edit Product Attribute');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAttribute $productAttribute,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:product_attributes,name,'.$id,
            'code'                      =>  'required|unique:product_attributes,code,'.$id,            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

     
        $productattribute = Productattribute::find($id);

        $productattribute->name = $request->input('name');
        $productattribute->code = str_slug($request->input('code'));        
        $productattribute->update();
         
        return redirect('admin/product-attributes/')->with("success", $request->input('name')." Product Attribute has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAttribute $productAttribute,$id)
    {
        $productattributes =DB::table('product_attributes')
                                      ->leftJoin('product_attribute_values', 'product_attribute_values.product_attribute_id', '=', 'product_attributes.id')
                                    ->where('product_attributes.id',$id)
                                    ->delete(); 
        
        return redirect('admin/product-attributes/')->with('success', 'Product Attribute has been deleted.');
    }


    //Attribute Value
    public function attributeValueStore(Request $request){
       
        $validator =Validator::make(
                        $request->all(), 
                        [            
               
                            'product_attribute_id' =>  'required',
                            'attvarname'           =>  'required|unique:product_attribute_values,name',
                            'attvarcode'           =>  'required|unique:product_attribute_values,code'
                        ],
                        $messages = [
                            'product_attribute_id.required' => 'The attribute id missing please reload the page',
                            'attvarname.required' => 'The attribute variation name required',
                            'attvarname.unique' => 'The attribute variation name already exist',
                            'attvarcode.required' => 'The attribute variation code required',
                            'attvarcode.unique' => 'The attribute variation code already exist',
                        ]
                    );
        if ($validator->fails()) {
            //return back()->withErrors($validator)->withInput();
            return response()->json(array(
                                    'status' => false,
                                    'errors' => $validator->getMessageBag()->toArray()

                                ));
        }
        
        $name=$request->input('attvarname');
        $productattributevalue = new ProductAttributeValue;
        $productattributevalue->product_attribute_id = $request->input('product_attribute_id');
        $productattributevalue->name = $request->input('attvarname');
        $productattributevalue->code = str_slug($request->input('attvarcode'));
        $productattributevalue->save();        
        if ($productattributevalue) {
            return response()->json([
                'status'     => true,
                'value'     => $name]);
        } else {
            return response()->json([
                'status' => false]);
        }
        
    }

    public function attributeValueDestroy(Productattributevalue $productattributevalue,$id,$attr_id)
    {
        
        //echo $id;
        $productattributes = DB::table('product_attribute_values')->where('id',$id)->delete(); 
        return redirect('admin/product-attributes/show/'.$attr_id)->with('success', 'Product Attribute Value has been deleted.');
    }

    public function attributeValueUpdate(Request $request, Productattributevalue $productattributevalue,$id)
    {   
        
       
        $validator =Validator::make(
                        $request->all(), 
                        [        
                            'attvarname'   =>  'required|unique:product_attribute_values,name,'.$id,
                            'attvarcode'   =>  'required|unique:product_attribute_values,code,'.$id
                        ],
                        $messages = [
                            'attvarname.required' => 'The attribute variation name required',
                            'attvarname.unique' => 'The attribute variation name already exist',
                            'attvarcode.required' => 'The attribute variation code required',
                            'attvarcode.unique' => 'The attribute variation code already exist',
                        ]
                    );

        if ($validator->fails()) {
            //return back()->withErrors($validator)->withInput();
            return response()->json(array(
                                    'status' => false,
                                    'errors' => $validator->getMessageBag()->toArray()

                                ));
        }
    
        
        $attvarname=$request->input('attvarname');
        $productattributevalue = ProductAttributeValue::find($id);
        $productattributevalue->name = $request->input('attvarname');
        $productattributevalue->code = $request->input('attvarcode');
        $productattributevalue->update();        
        if ($productattributevalue) {
            return response()->json([
                'status'     => true,
                'value'     => $attvarname]);
        } else {
            return response()->json([
                'status' => false]);
        }
    }


    //Get Variation in Create Product
    public function getAttributeVariation(ProductAttribute $productAttribute,$id)
    {
          
        return $productattributesvalues = DB::table('product_attribute_values')->where('product_attribute_id',$id)->orderBy('id','desc')->get();  
         
    } 

}
