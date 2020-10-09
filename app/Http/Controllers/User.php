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

 public function view_logout(Request $request){
    $request->session()->flush();
    return redirect('/login');
}
public function view_game(Request $request){
    if(!$request->session()->has('username')){
        $request->session()->flush();
        return redirect('/login');
    }
    return view('users.game');
}














public function api_getGameByid(Request $request, $id){
    if(!$request->session()->has('username')){
        $request->session()->flush();
        return redirect('/login');
    }
    $publisher = new Publisher();
    $result = $publisher->getGameByid($id);
    $data = [];
    
    if (count($result)<1){
        return abort(404);
    }
    $data['game']=$result[0]->Name;
    $data['desc']=$result[0]->Game_Desc;
    $data['publisher']=$result[0]->Publisher_Name;
    $data['genre']=$result[0]->Genre;
    $data['site']=$result[0]->Site??'-';
    $data['game_id']=$result[0]->Game_id;

    return response()->json([
        'data' => $data,
        'status' => 'OK',
      ]);
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
        $data = [
        ];
        
        $arr_data = array();
        for($i=0;$i< count($result);$i++){
        $data['game']=$result[$i]->Name;
        $data['genre']=$result[$i]->Genre;
        $data['site']=$result[$i]->Site??'-';
        $data['id']=$result[$i]->Game_id;
        array_push($arr_data, $data);
        }


        return response()->json([
            'data' => $arr_data,
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
                'id' => ['Required','Integer']
            ];
            $data['id'] = $id;
            if (!isset($data['id'])){
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

        //update




        public function api_update(Request $request){
            if(!$request->session()->has('username')){
                $request->session()->flush();
                return redirect('/login');
            }
            $validator = Validator::make($request->All(),[
                'name'=>['required', 'string'],
                'desc'=>['string'],
                'genre'=>['string'],
                'site'=>['url'],
                'id'=>['integer'],
    
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
          $result =  $publisher->updateGame($request->input('id'));
          if ($result<1){
            return response()->json([
                'message' =>'check again the form',
                'status' => 'OK',
            ]);
          }
          return response()->json([
            'message' => 'OK',
            'status' => 'OK', ]);
        }
}


?>