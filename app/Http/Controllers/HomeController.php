<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Friend_request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $users = User::where('id','!=',Auth::id())->paginate(10);
   
        return view('users',compact('users'));
    }
    public function create(Request $request){
        $request['sender_id']=Auth::id();
        $request['status']=1;
        $users = Friend_request::create($request->input());
        if($users){
            return response()->json(array('msg'=> 'Request Sent'), 200);
        }else{
            return response()->json(array('msg'=> "Can't sent request"), 401);
        }
    }
    public function accept(Request $request){
        $requests =Friend_request::where('sender_id','=',$request->sender_id)->where('receiver_id','=',Auth::id())->where('status','=',1)->first();
        if(!empty($requests)){
            if($request->status=='accept'){
                $requests->status=2;
                $msg='Friend';
            }else{
                $requests->status=3; 
                $msg='Rejected';  
            }
            
            $requests->save();
        return response()->json(array('msg'=> $msg), 200);
        }else{
            return response()->json(array('msg'=> "OOps something went wrong"), 401);
        }
    }
    public function friends(){
       $friends = Friend_request::with('sender','receiver')->where(function ($query) {
    $query->where('sender_id', '=', Auth::id())
          ->orwhere('receiver_id', '=', Auth::id());
})->where('status','=',2)->paginate();
        $title = 'Friends List';
       return view('friends',compact('friends','title'));

    }
    public function requests(){
       $friends = Friend_request::with('sender','receiver')->where('receiver_id', '=', Auth::id())->where('status','=',1)->paginate(10);
       $title = 'Friends Request';
       return view('friends',compact('friends','title'));

    }
    
}
