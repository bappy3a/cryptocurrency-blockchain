<?php

namespace App\Http\Controllers;

use App\Process;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcessController extends Controller
{

	public function index()
	{
		$products = Process::where('user_id', Auth::id())->get();
		return view('products',compact('products'));

	}

    public function store($id)
    {

    	$user_id = Auth::id();
    	if (!empty(Auth::user()->referrel_id)) {
    		$ref_1 = Auth::user()->referrel_id;
    	}else {
    		$ref_1 = 0;
    	}
    	if (!empty(User::find($ref_1)->referrel_id)) {
    		$ref_2 = User::find($ref_1)->referrel_id;
    	}else {
    		$ref_2 = 0;
    	}
    	if (!empty(User::find($ref_2)->referrel_id)) {
    		$ref_3 = User::find($ref_2)->referrel_id;
    	}
    	

    	$produce = Product::find($id);
    	$process = New Process();
    	$process->user_id = $user_id;
    	$process->product_name = $produce->name;
    	$process->product_price = $produce->price;
    	if (!empty($ref_1)) {
    		$process->ref_1 = $ref_1;
    	}
    	if (!empty($ref_2)) {
    		$process->ref_2 = $ref_2;
    	}
    	if (!empty($ref_3)) {
    		$process->ref_3 = $ref_3;
    	}
    	
    	
    	
    	$process_save = $process->save();

    	$user = User::find($user_id);
    	$user->amaunt = $user->amaunt + $produce->price;
    	$user->save();
    	if (!empty($ref_1)){
    		$user = User::find($ref_1);
    		$user->amaunt = $user->amaunt + ( 20 / 100 ) * $produce->price;
    		$user->save();
    	}
    	if (!empty($ref_2)) {
    		$user = User::find($ref_2);
    		$user->amaunt = $user->amaunt + ( 10 / 100 ) * $produce->price;
    		$user->save();
    	}
    	if (!empty($ref_3)) {
    		$user = User::find($ref_3);
    		$user->amaunt = $user->amaunt + ( 5 / 100 ) * $produce->price;
    		$user->save();
    	}


    	if ($process_save) {
    		return redirect()->route('home');
    	}else{
    		swal("Opps !!", "Process not sussesfully Complate", "error");
    	}


    }
}
