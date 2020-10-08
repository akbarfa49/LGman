<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Publisher{

   public $game = ['name'=>'', 'desc'=>'', 'genre' => '', 'site' =>'' ];

   public function addGame($id){
      $table = DB::select('select Name from game_info where Name = ?', [$this->game['name']]);
       if(count($table)<1){
         $result=DB::insert('insert into game_info values (?, ?, ?, ?, ?, ?, ?)', [$id, $this->game['name'],  $this->game['genre'],$this->game['desc'], $this->game['site'],date("Y-m-d H:i:s"), date("Y-m-d H:i:s")]);
    return $result;
   };
   
   return false;
   }
   public function getGame($id){
        $result = DB::select('select * from game_info where Publisher_id = ?', [$id]);
    return $result;
   }
   public function delete($id){
      $status = DB::delete('delete FROM game_info where Publisher_Id = ?)', [$id]);
      return $status;
  }
}

?>