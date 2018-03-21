<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemsModel;
use Exception;

class ItemsController extends Controller
{
  protected $items;
  public function __construct(ItemsModel $items) // dependency injection
  {
    $this->items = $items;
  }
  public function Create(Request $request){
      $items = [
        "user_id"     => $request->user_id,
        "name"    => $request->name,
        "price" => $request->price,
        "stock" => $request->stock
      ];
      try{
          $add = $this->items->create($items); //queery insert
          return response('Items Created',201);
        }
      catch(Exception $ex){
          return response($ex,400);
        }
    }
    public function all(){
      $all =$this->items->all(); // select all from table items
      return response()->json($all,200);
    }
    public function delete($id){
      try{
        $del = $this->items->where('id', $id)->delete();
        return response("DELETED", 201);
      }
      catch(Exception $ex){
        return response($ex,400);
      }
    }
    public function update(Request $request, $id){
      try{
        $query = $this->items->find($id);
          if($query)
          {
            $query->user_id =$request->user_id;
            $query->name =$request->name;
            $query->price=$request->price;
            $query->stock=$request->stock;
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
          return response("Items ID NOT FOUND",400);
        }
      }
}
