<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id', 'name', 'address', 'phone',
	];

	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'created_at', 'updated_at'
	];

	/**
	 * Get all of the credits for the client.
	 */
	public function credits()
	{
		return $this->hasMany('App\Credit');
	}
}
