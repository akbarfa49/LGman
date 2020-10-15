<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Account {
    protected $email;
    protected $password;
    public function user($emailwrp, $pass){
        $this->email = $emailwrp;
        $this->password = md5($pass);
    }
    public $profile=[
        'Publisher_Name'=>'',
         'Publisher_Description'=>'',
         'Website_URL'=>'',
         'Address'=>''
    ];

    public function login($table){
        if ($table != 'admin'){
            
            $result =DB::select('select profile.Publisher_Name, profile.Publisher_Id from profile join users on Profile.id = users.id where users.email = ? AND users.password = ?',[ $this->email, $this->password] );
            return $result;
        }
        $result=DB::table('admin')
        ->where(function($query){
            $query->where('admin.email', '=',$this->email)
            ->where('admin.password', '=', $this->password);
        })
        ->value('username');
        return $result;
    }
    public function create($username){
        $status = DB::insert('insert into users values (?, ?, ?, ?, ?)', [null, $this->email, $this->password, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('insert into profile (profile.id, profile.Publisher_Name) values ((SELECT id from users WHERE email= ?), ?)', [$this->email, $username]);
        return $status;
    }
    public function delete($id){
        $status = DB::delete('delete FROM users where id = (SELECT id FROM profile where Publisher_Id = ?)', [$id]);
        return $status;
    }

    public function getData(){
        $result = DB::select('select 
        users.email, 
        profile.Publisher_Name,
        profile.Publisher_Id,
        profile.Address,
        profile.Website_URL
          from users JOIN profile 
          ON users.id = profile.id
          ' );
          return $result;
    }

   
  public function getProfile($id){
    $result[0] = DB::select('select Publisher_Name, Publisher_Description, Website_URL, Address FROM profile where Publisher_id = ?', [$id]);
    return $result;
   }


   //$id is publisher_id
   public function updateProfile($id){
       $arrKey = [];
        $arrv = [];
    foreach($this->profile as $key => $value){
        if($value!= null || $value!= ''){
        array_push($arr, $key);
        array_push($arrv, $value);
    }
    }
    $query = 'update profile set '.join(' = ?,', $arr).' where Publisher_id = ?';
    array_push($arrv, $id);
    $result = DB::select($query, $arrv);
    return $result;
   }
}

?>