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
    public function login($table){
        if ($table != 'admin'){
            /*$result = DB::table('users')
            ->join('profile', function ($join){
                $join-> on('users.id', '=', 'profile.id')
                ->where('users.email', '=', $this->email)
                ->where( 'users.password', '=', $this->password);
            })->value('profile.Publisher_Id', 'profile.Publisher_Name');*/
            $result =DB::select('select profile.Publisher_Name, profile.Publisher_Id from profile join users on Profile.id = users.id where users.email = ? AND users.password = ?',[ $this->email, $this->password] );
            return $result;
            //$result = DB::select('select * from ? where email = ? and password = ?', $email, $password);
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
        $status = DB::insert('insert into users values (?, ?, ?, ?, ?)', [null, $this->email, $this->password, date("Y-m-d H:i:s"), date("Y-m-d H:i:s")]);
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
}

?>