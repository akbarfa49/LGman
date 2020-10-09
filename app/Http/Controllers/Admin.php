<?php

namespace App\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class Admin extends Controller
{

//make admin account directly from mysql or phpmyadmin with password column using md5 encrypt
    
    
//view AREA

    public function view_login(){
        return view('admin.login');
    }
    
    public function view_dashboard(Request $request){
        $level = $request->session()->get('level');
        if($request->session()->get('level')!='administrator'){
            $request->session()->flush();
             return redirect('/admin/login');
        }
        return view('admin.dashboard');
    }
    public function view_logout(Request $request){
        $request->session()->flush();
        return redirect('/admin/login');
    }

    public function login_bypass(Request $request){
        $request->session()->put('username', 'admin');
         $request->session()->put('level', 'administrator');
        
          return redirect('/admin/dashboard');
}























//API AREA

    public function api_getdata(Request $request){
        $level = $request->session()->get('level');
        if($request->session()->get('level')!='administrator'){
            $request->session()->flush();
             return redirect('/admin/login');
        }
        $account = new Account();
        $result = $account->getData();
        $data = [
        ];
        
        $arr_data = array();
        for($i=0;$i< count($result);$i++){
        $data['publisher']=$result[$i]->Publisher_Name;
        $data['id']=$result[$i]->Publisher_Id;
        $data['email']=$result[$i]->email;
        $data['address']=$result[$i]->Address;
        $data['website']=$result[$i]->Website_URL;
        array_push($arr_data, $data);
    };
        return response()->json([
            'username'=> $request->session()->get('username'),
            'data' => $arr_data,
            'message' =>'success',
            'status' => 'OK',
        ]);

    }

    public function api_login(Request $request){
                    $validator = Validator::make($request->All(),[
                        'email'=> ['required', 'email'],
                        'pass'=> ['required', 'between:8,16', 'string'],
                    ]);
                    if($validator->fails()){
                        return response()->json([
                        'message' =>'invalid email or password',
                        'status' => 'OK',
                    ]);
                }

                
                    $email = $request->input('email');
                    $pass = $request->input('pass');
                    
                    $account = new Account();
                    $account->user($email, $pass);
                    $result = $account->login('admin');
                    if($result==null){
                        return response()->json([
                        'message' => 'invalid email or password',
                        'status' => 'OK',
                    ]);}
                 $request->session()->put('username', $result);
                 $request->session()->put('level', 'administrator');
                
                  return response()->json([
                    'location' => '/admin/dashboard',
                    'message' => 'success',
                    'status' => 'OK',
                  ]);
    }


    public function api_create(Request $request){
        if($request->session()->get('level')!='administrator'){
            $request->session()->flush();
            return redirect('/admin/login');
        }
        $validator = Validator::make($request->All(),[
            'email'=> ['required', 'email'],
            'pass'=> ['required', 'between:8,16', 'string'],
            'username'=>['required', 'string']
        ]);
        if($validator->fails()){
            return response()->json([
            'message' => 'invalid email or password',
            'status' => 'OK',
        ]);
    }

        $account = new Account();
        $account->user($request->input('email'), $request->input('pass'));
        $result = $account->create($request->input('username'));
        if ($result != true){
            return response()->json([
                'message' => 'user already exists',
                'status' => 'OK',
            ]);
        }
        return response()
                        ->json([
                        'message' => 'success',
                        'status' => 'OK',
                        ], 201);
    }

    public function api_delete(Request $request, $id){
        if($request->session()->get('level')!='administrator'){
            $request->session()->get('level');
            $request->session()->flush();
            return redirect('/admin/login');
        }
         $data = [
            'Publisher_Id' => ['Required','Integer']
        ];
        $data['Publisher_Id'] = $id;
        if (!isset($data['Publisher_Id'])){
            return response()->json([
                'message' => 'wrong input',
                'status' => 'OK',
            ]);
        }
        $account = new Account();
        $status = $account->delete($data['Publisher_Id']);
        if ($status <1){
            return response()->json([
                'message' => 'data doesnt exists',
                'status' => 'OK',
            ]);
        }
                return response()->json([
                    'message' => 'delete success',
                    'status' => 'OK',
                ]);
    }

  
}
