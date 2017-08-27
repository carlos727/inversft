<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
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

	/**
	 * Do database test.
	 */
	public function test()
	{
		return $this->assertDatabaseHas('clients', ['id' => 1140789456]);
		//return $this->assertDatabaseMissing('clients', ['id' => 1140789456]);
		//return $this->assertSoftDeleted('clients', ['id' => 1140789456]);
	}
}
