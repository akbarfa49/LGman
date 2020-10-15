<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\Validator;

class Profile extends Controller
{
    function __constructor(Request $request){
        if(!$request->session()->has('username')){
            $request->session()->flush();
            return redirect('/login');
        }
    }
    public function view_Index(){
        return view('user.profile');
    }

    public function api_data(Request $request){
        $account = new Account();
        $result = $account->getProfile($request->session()->get('id'));
        if ($result == ''){
            return response()->json(
                ['message'=> 'cant get any data',
                'status'=>'FAIL'
                ]
            );
        }
        return response()->json(
            ['data'=> $result,
            'status'=>'OK'
            ]
        );
    }
    public function api_update(Request $request){
        $account = new Account();
        $validator = Validator::make($request->All(), [
            'name'=>['string', 'nullable'],
            'desc'=>['string', 'nullable'],
            'url'=>['url', 'nullable'],
            'address'=>['string', 'nullable']
        ]);
        if($validator->fails()){
            return response()->json([
            'message' =>'check again the form',
            'status' => 'fails',
        ]);}
        $account->profile=[
            'Publisher_Name'=> $request->input('name'),
             'Publisher_Description'=>$request->input('desc'),
             'Website_URL'=>$request->input('url'),
             'Address'=>$request->input('address')
        ];
        $result = $account->updateProfile($request->session()->get('id'));
        if($result!=1){
            return response()->json([
                'message' =>'nothing changed',
                'status' => 'OK',
            ]);
        }
        return response()->json([
            'message' =>'Profile changed',
            'status' => 'OK',
        ]);
    }
}
