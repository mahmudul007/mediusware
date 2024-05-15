<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
   public function create(Request  $request){

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'account_type'=>'required'
       
       
    ]);

    // Creating a new user
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->account_type = $request->account_type;
    $user->balance = $request->balance??0;
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('success', 'User created successfully');



   }
}
