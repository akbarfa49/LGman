<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\Validator;
use App\Publisher;
class User extends Controller
{
 public function view_login()
 {
     return view('users.login');
 }

 public function view_dashboard(Request $request){
    if(!$request->session()->has('username')){
        $request->session()->flush();
        return redirect('/login');
    }
    return view('users.dashboard');
 }















 public function api_login(Request $request)
 {
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
    $result = $account->login('users');
    if($result==null){
        return response()->json([
        'message' => 'invalid email or password',
        'status' => 'OK',
    ]);}
 $request->session()->put('username', $result[0]->Publisher_Name);
 $request->session()->put('id', $result[0]->Publisher_Id); 
  return response()->json([
    'location' => '/dashboard',
    'message' => 'success',
    'status' => 'OK',
  ]);
 }



    public function api_getGame(Request $request){
        if(!$request->session()->has('username')){
            $request->session()->flush();
            return redirect('/login');
        }
        $publisher = new Publisher();
        $result = $publisher->getGame($request->session()->get('id'));
        return response()->json([
            'message' => $result,
            'status' => 'OK',
          ]);
    }
    
    public function api_createGame(Request $request){
        if(!$request->session()->has('username')){
            $request->session()->flush();
            return redirect('/login');
        }
        $validator = Validator::make($request->All(),[
            'name'=>['required', 'string'],
            'desc'=>['string'],
            'genre'=>['string'],
            'site'=>['url'],

        ]);
        if($validator->fails()){
            return response()->json([
            'message' =>'check again the form',
            'status' => 'OK',
        ]);};
        $publisher = new Publisher();
        $publisher->game['name']=$request->input('name');
        $publisher->game['desc']=$request->input('desc');
        $publisher->game['genre']=$request->input('genre');
        $publisher->game['site']=$request->input('site');
        $result = $publisher->addGame($request->session()->get('id'));

        if ($result != true){
        
            return response()->json([
                'message' => $result,
                'status' => 'OK',
            ]);
        }
        
        return response()->json([
            'message' => 'game added',
            'status' => 'OK',
        ]);
    }





        public function api_delete(Request $request, $id){
            if(!$request->session()->has('username')){
                $request->session()->flush();
                return redirect('/login');
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
            $publisher = new Publisher();
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
?>