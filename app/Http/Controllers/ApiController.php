<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ApiController extends Controller
{
	public function getItems() {
		$response = array();
		$response['data'] = Item::all();
		$response['count'] = Item::count();
		return response()->json($response);
	}
}