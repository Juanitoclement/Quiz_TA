<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use Exception;

class UserController extends Controller
{
  protected $user;
  public function __construct(UserModel $user) // dependency injection
  {
    $this->user = $user;
  }
  public function Create(Request $request){
      $user = [
        "name"    => $request->name,
        "email" => $request->email,
        "password" => $request->password
      ];
      try{
          $add = $this->user->create($user); //queery insert
          return response('User Created',201);
        }
      catch(Exception $ex){
          return response($ex,400);
        }
    }
    public function all(){
      $all =$this->user->all(); // select all from table user
      return response()->json($all,200);
    }
    public function delete($id){
      try{
        $del = $this->user->where('id', $id)->delete();
        return response("DELETED", 201);
      }
      catch(Exception $ex){
        return response($ex,400);
      }
    }
    
    public function update(Request $request, $id){
      try{
        $query = $this->user->find($id);
          if($query)
          {
            $query->name =$request->name;
            $query->email=$request->email;
            $query->password=$request->password;
          }
          try{
            $update =  $query->save();
            if($update)
            {
              return response("Updated", 201);
            }
          }
          catch(Exception $ex){
            return response("Not Updated",400);
          }
        }
        catch(Exception $ex){
          return response("User ID NOT FOUND",400);
        }
      }

    public function useritem($id){
      try{
        $query = $this->user->find($id);
        if($query)
        {
          $show =$this->user->where('id',$id)->with('itemconnect')->get();
        }
        return response()->json($show,200);
      }
      catch(Exception $ex){
        return response("User ID NOT FOUND",400);
      }
    }

    public function alluseritem(){
      try{
        $show =$this->user->with('itemconnect')->get();
        return response()->json($show,200);
      }
      catch(Exception $ex){
        return response("User ID NOT FOUND",400);
      }
    }
}
