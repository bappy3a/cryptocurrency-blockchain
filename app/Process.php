<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
	protected $fillable = [
        'user_id','product_name','product_price','ref_1','ref_2','ref_3',
    ];
    
}
