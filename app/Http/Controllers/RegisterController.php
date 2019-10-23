<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class RegisterController extends Controller
{
    
    public function index()
    {
        $user = DB::table('users')->get();
        return response()->json($user);
    }

    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required',
                                    'email' =>'required|email|unique:users',
                                    'password'=>'required'
                                    ]);
        $data['password'] = Hash::make($data['password']); 
        User::create($data);
        $user = DB::table('users')->get();
        
        return response()->json($user);
    }

    public function show($id)
    {
        return 'mukessdasdsadadsh';
    }

    
    public function edit($id)
    {
        $data = DB::table('users')->where('id',$id)->get();
        return response()->json($data); 
    }

    public function update(Request $request, $id)
    {
       $data = $request->validate(['name'=>'required',
                                   'password'=>'required'
                                  ]);
       $data['password'] = Hash::make($data['password']); 
       DB::table('users')->all();
       $user = DB::table('users')->get();
       return response()->json($user);
    }

   
    public function destroy($id)
    {
        User::destroy($id);
        $user = DB::table('users')->get();
        return response()->json($user);

    }
}
