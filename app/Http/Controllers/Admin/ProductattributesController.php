<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productattribute;
use App\Models\Productattributevalue;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class ProductattributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productattributes = DB::table('productattributes')->get();  
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
           
            'name'                      =>  'required|unique:productattributes',
            'code'                      =>  'required|unique:productattributes',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $productattribute = new Productattribute;

        $productattribute->name = $request->input('name');
        $productattribute->code = str_slug($request->input('code'));
        $productattribute->save();
         
        return redirect('admin/product-attributes/')->with('success', 'New Product Attributes has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productattribute  $productattribute
     * @return \Illuminate\Http\Response
     */
    public function show(Productattribute $productattribute,$id)
    {
        $productattributes = DB::table('productattributes')->where('id',$id)->first();  
        $productattributesvalues = DB::table('productattributevalues')->where('productattribute_id',$id)->orderBy('id','desc')->get();  
        return view('admin.ecommerce.attributes.view',['productattributes' => $productattributes,'productattributesvalues'=>$productattributesvalues])->withTitle('Product Attribute Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productattribute  $productattribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Productattribute $productattribute,$id)
    {
        $productattributedtl = DB::table('productattributes')->where('id',$id)->get();        
            
        return view('admin.ecommerce.attributes.edit',['productattributedtl'=>$productattributedtl])->withTitle('Edit Product Attribute');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productattribute  $productattribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productattribute $productattribute,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required|unique:productattributes,name,'.$id,
            'code'                      =>  'required|unique:productattributes,code,'.$id,            
            
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
     * @param  \App\Models\Productattribute  $productattribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productattribute $productattribute,$id)
    {
        $productattributes = DB::table('productattributes')->where('id',$id)->delete(); 
        return redirect('admin/product-attributes/')->with('success', 'Product Attribute has been deleted.');
    }


    //Attribute Value
    public function attributeValueStore(Request $request){
        $validator = Validator::make($request->all(), [            
           
            'productattribute_id'                      =>  'required',
            'value'                                    =>  'required|unique:productattributevalues',            
            
        ]);
        if ($validator->fails()) {
            //return back()->withErrors($validator)->withInput();
            return response()->json(array(
                                    'status' => false,
                                    'errors' => $validator->getMessageBag()->toArray()

                                ));
        }
        $val=$request->input('value');
        $productattributevalue = new Productattributevalue;
        $productattributevalue->productattribute_id = $request->input('productattribute_id');
        $productattributevalue->value = $request->input('value');
        $productattributevalue->save();        
        if ($productattributevalue) {
            return response()->json([
                'status'     => true,
                'value'     => $val]);
        } else {
            return response()->json([
                'status' => false]);
        }
        
    }

    public function attributeValueDestroy(Productattributevalue $productattributevalue,$id,$attr_id)
    {
        
        //echo $id;
        $productattributes = DB::table('productattributevalues')->where('id',$id)->delete(); 
        return redirect('admin/product-attributes/show/'.$attr_id)->with('success', 'Product Attribute Value has been deleted.');
    }

    public function attributeValueUpdate(Request $request, Productattributevalue $productattributevalue,$id)
    {   
        $validator = Validator::make($request->all(), [            
            'productattribute_id'        =>  'required',
            'value'                      =>  'required|unique:productattributevalues,value,'.$id,         
            
        ]);

        if ($validator->fails()) {
            //return back()->withErrors($validator)->withInput();
            return response()->json(array(
                                    'status' => false,
                                    'errors' => $validator->getMessageBag()->toArray()

                                ));
        }
        // echo $id.'<br>';
        // echo  $request->input('productattribute_id');
        // die;
        $val=$request->input('value');
        $productattributevalue = Productattributevalue::find($id);
       // $productattributevalue->productattribute_id = $request->input('productattribute_id');
        $productattributevalue->value = $request->input('value');
        $productattributevalue->update();        
        if ($productattributevalue) {
            return response()->json([
                'status'     => true,
                'value'     => $val]);
        } else {
            return response()->json([
                'status' => false]);
        }
    }

}
