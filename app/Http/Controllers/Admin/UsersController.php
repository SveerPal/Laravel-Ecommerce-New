<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = DB::table('users')->get();  
        return view('admin.users.index',['users' => $users])->withTitle('Users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create')->withTitle('Create User');
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
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required',
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 

            $extension = $request->file('image')->extension();
            $image = $request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('image')->storeAs('public/uploads/clienteles',$image);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        $clientele = new Clientele;

        $clientele->name = $request->input('name');
        $clientele->link = $request->input('link');
        $clientele->image = $image;
        $clientele->alt = $request->input('alt');
        $clientele->save();
         
        return redirect('admin/clienteles/')->with('success', 'New clientele has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,$id)
    {
        $users = DB::table('users')->where('id',$id)->first();  
        return view('admin.users.view',['users' => $clienteles])->withTitle('User Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,$id)
    {
        $usersdtl = DB::table('users')->where('id',$id)->get();        
             
        return view('admin.users.edit',['usersdtl'=>$usersdtl])->withTitle('Edit User');
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,$id)
    {
        $validator = Validator::make($request->all(), [            
           
            'name'                      =>  'required',
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 

            $extension = $request->file('image')->extension();
            $image = $request->input('name').'.'.$extension;//$request->file('site_logo')->getClientOriginalName();               
            $path = $request->file('image')->storeAs('public/uploads/clienteles',$image);
           /// Setting::where('id', '=', 1)->update(['banner'=>$site_logo]);
        }
        else{
            $image=$request->input('image_old');
        }
        $user = User::find($id);;

        $user->name = $request->input('name');
        $user->link = $request->input('link');
        $user->image = $image;
        $user->alt = $request->input('alt');
        $user->update();
         
        return redirect('admin/users/')->with("success", $request->input('name')." User has been updated.");
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id)
    {
          $users = DB::table('users')->where('id',$id)->delete(); 
        return redirect('admin/users/')->with('success', 'User has been deleted.');
    }
}
