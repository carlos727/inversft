<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'value',
    	'fee',
    	'type',
    	'start_at',
    	'active'
    ];

    /**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'created_at',
		'updated_at'
	];

	/**
     * Get the client that owns the credit.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

	/**
     * Get all of the payments for the credit.
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
