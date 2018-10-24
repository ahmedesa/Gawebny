<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table ='report';
	protected $fillable = ['user_id','type','details' ,'reported_id'];
	public function user()
	{
		return	$this->belongsTo(User::class);
	}



}
