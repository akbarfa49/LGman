<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Publisher{

   public $game = ['name'=>'', 'desc'=>'', 'genre' => '', 'site' =>'' ];

   public function addGame($id){
      $table = DB::select('select Name from game_info where Name = ?', [$this->game['name']]);
       if(count($table)<1){
         $result=DB::insert('insert into game_info values (?, ?, ?, ?, ?, ?, ?, ?)', [$id, null, $this->game['name'],  $this->game['genre'],$this->game['desc'], $this->game['site'],date("Y-m-d H:i:s"), date("Y-m-d H:i:s")]);
    return $result;
   };
   
   return false;
   }
   public function getGame($id){
        $result = DB::select('select * from game_info where Publisher_id = ?', [$id]);
    return $result;
   }
   public function delete($id){
      $status = DB::delete('delete FROM game_info where Game_id  = ?', [$id]);
      return $status;
  }
  public function getGameByid($id){
     $result = DB::select('select p.Publisher_Name, g.Name, g.Game_id, g.Genre, g.Game_Desc, g.Site  from game_info as g join profile as p on p.Publisher_id = g.Publisher_id where g.Game_id = ?', [$id]);
     return $result;
  }
  public function updateGame($id){
     $result = DB::update('update game_info set Name = ?, Genre = ?, Game_Desc =?, Site = ? where Game_id = ?', [$this->game['name'],  $this->game['genre'],$this->game['desc'], $this->game['site'], $id ]);
     return $result;
  }
}

?>