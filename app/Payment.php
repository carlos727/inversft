<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'credit_id', 'value', 'date',
    ];

    /**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'created_at', 'updated_at',
	];

    /**
     * Get the credit that owns the payment.
     */
    public function credit()
    {
        return $this->belongsTo('App\Credit');
    }
}
