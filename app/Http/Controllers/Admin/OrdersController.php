<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


//use App\Models\orders_details;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')->get();  
        return view('admin.ecommerce.orders.index',['orders' => $orders])->withTitle('Orders');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ecommerce.orders.create')->withTitle('Create Order');
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
           
            'name'                      =>  'required|unique:orders',
            'code'                      =>  'required|unique:orders',            
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $productattribute = new ProductAttribute;

        $productattribute->name = $request->input('name');
        $productattribute->code = str_slug($request->input('code'));
        $productattribute->save();
         
        return redirect('admin/orders/')->with('success', 'Order has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orders = DB::table('orders')->where('id',$id)->first();  
        $orders_details = DB::table('orders_details')->where('product_attribute_id',$id)->orderBy('id','desc')->get();  
        return view('admin.ecommerce.attributes.view',['orders' => $orders,'orders_details'=>$orders_details])->withTitle('Order Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        /*$productattributedtl = DB::table('product_attributes')->where('id',$id)->get(); 
        return view('admin.ecommerce.attributes.edit',['productattributedtl'=>$productattributedtl])->withTitle('Edit Product Attribute');*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        /*$validator = Validator::make($request->all(), [            
           
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
         
        return redirect('admin/product-attributes/')->with("success", $request->input('name')." Product Attribute has been updated.");*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        /*$productattributes =DB::table('product_attributes')
                                      ->leftJoin('product_attribute_values', 'product_attribute_values.product_attribute_id', '=', 'product_attributes.id')
                                    ->where('product_attributes.id',$id)
                                    ->delete(); 
        
        return redirect('admin/product-attributes/')->with('success', 'Product Attribute has been deleted.');*/
    }
}
