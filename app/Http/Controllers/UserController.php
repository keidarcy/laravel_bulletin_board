<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserController extends Controller
{

      public function edit(Request $request)
      {
          if($request->isMethod("get"))
          {
            $user = Auth::user();
            return view('get_user_edit', array('user' => $user));
          } else
          {

            $validate_rules = [
              "name" => "required|max:255",
              "email" => "required|email",
              "password" => 'required|alpha_num'
            ];

            $validator = Validator::make($request->all(),$validate_rules);

            if($validator->fails()) {
                return redirect()->route("get_user_edit")->withErrors($validator)->withInput();
            }

            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);


            if($request->file("image")) {
                $path = $request->file('image')->store('public/icon');
                $user->image = str_replace("public", "storage", $path);
            }

            $user->save();
            return redirect()->route('get_post_index');

          }




      }

}
