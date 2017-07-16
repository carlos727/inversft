<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Payment;
use Validator;


class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application index.
     */
    public function show($id)
    {
        $payments = Payment::where('credit_id', $id)->get();

    	return view('payments',[
    		'payments' => $payments
    	]);
    }

    /**
     * Store a new client.
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'client_id'	=>	'required',
    		'credit_id'	=>	'required',
    		'value'		=>	'required',
    		'date'		=>	'required'
    	]);

    	if ($validator->fails()) {
    		return redirect()
    			->action('CreditController@index')
    			->withErrors($validator->errors());
    	}

    	$payment = new Payment;
    	$payment->cliente_id= $request->input('cliente_id');
    	$payment->credit_id	= $request->input('credit_id');
    	$payment->value 	= $request->input('value');
    	$payment->date		= $request->input('date');
    	$payment->save();

    	return redirect()->action('CreditController@index');
    }

    /**
     * Delete a payment.
     */
    public function delete($id)
    {
		//
	}

	/**
     * Update a payment.
     */
	public function update($id, Request $request)
	{
		//
	}
}
