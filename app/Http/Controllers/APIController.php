<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;

class APIController extends Controller
{
    public function getItems(){
        $items = Item::all();
        $count = $items->count();
        $data = collect(["data"=>$items, "count"=>$count]);
        return $data->toJson();
    }
    

}