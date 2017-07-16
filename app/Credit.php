<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\Payment;

class Credit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
    	'value',
    	'fee',
    	'type',
        'revenue',
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
        return $this->belongsTo('Client');
    }

	/**
     * Get all of the payments for the credit.
     */
    public function payments()
    {
        return $this->hasMany('Payment');
    }
}
