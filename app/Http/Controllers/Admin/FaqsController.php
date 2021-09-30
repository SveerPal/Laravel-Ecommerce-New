<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = DB::table('faqs')->get();  
        return view('admin.faqs.index',['faqs' => $faqs])->withTitle('Faq\'s');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create')->withTitle('Create FAQ');
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
           
            'title'                      =>  'required',
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        
        $faq = new Faq;

        $faq->title = $request->input('title');
        $faq->description = $request->input('description');
        $faq->save();
         
        return redirect('admin/faqs/')->with('success', 'New Faq has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq,$id)
    {
       
         $faqsdetails = DB::table('faqs')->where('id',$id)->get();        
             
        return view('admin.faqs.edit',['faqsdetails'=>$faqsdetails])->withTitle('Edit Faq');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq,$id)
    {
         $validator = Validator::make($request->all(), [            
           
            'title'                      =>  'required',
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $faq = Faq::find($id);;

        $faq->title = $request->input('title');
        $faq->description = $request->input('description');
        $faq->update();
         
        return redirect('admin/faqs/')->with("success", $request->input('name')." faqs has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq,$id)
    {
        $faqs = DB::table('faqs')->where('id',$id)->delete(); 
        return redirect('admin/faqs/')->with('success', 'Faq has been deleted.');
    
    }
}
