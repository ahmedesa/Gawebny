<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccunt extends Model
{
	protected $fillable =[
		'user_id', 'provider', 'provider_user_id'
	];
	public function user()
	{
		return $this->belongsTo(User::class);

	}
}
