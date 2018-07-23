<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;
use Chatty\User;
use Illuminate\Support\Facades\DB;
use Chatty\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getResults(Request $request){
    	$query = $request->query; // помним что в навигатор поле ввода с именем query
    	if(!$query) return $redirect('/');
    	foreach($query as $x){
    		$str = $x;
    	}
    	//dd($str);
    	$users = User::where(DB::raw("CONCAT(last_name)"),'LIKE',"%{$str}%")
    	->orWhere('username','LIKE',"%{$str}%")
    	->orWhere('first_name','LIKE',"%{$str}%")
    	->get();
    	   	
    	//dd($users);
    	return view('search.results')->withUsers($users);
    }
   
}
