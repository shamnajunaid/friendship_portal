<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;

class UserController extends Controller
{

    public function edit_profile()
    {  
        $user = Auth::user();
        return view('edit_profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['nullable','string', 'min:8', 'confirmed'],
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048']
        ]);
        if ($validator->fails()) {
            return redirect('profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::find($id);
        
        if(!empty($request->image)){
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);
        $request['img']=$imageName;
        @unlink(public_path('images/'.$user->img));
       }
       if(empty($request['password'])){
        unset($request['password']);
       }else{
        $request['password'] = bcrypt($request['password']);
       }
       $user->update($request->input());

       return redirect('/profile')->with('success','Profile Updated Successfully');
    }

    
}
