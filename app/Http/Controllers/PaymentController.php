<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests;
use App\Payment;
use App\Credit;

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
	public function show()
	{
		return view('payments',[
			'navbar' => ['', '', ''],
			'payments' => Payment::all()//where('credit_id', $id)->get()
		]);
	}

	/**
	 * Store a new client.
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'credit_id'	=>	'required|numeric',
			'value'		=>	'required|numeric|min:1',
			'date'		=>	'required|date'
		]);

		$validator->after(function ($validator) {

			$credit_id = array_get($validator->getData(), 'credit_id', null);
			$date = date('Y-m-d', strtotime(array_get($validator->getData(), 'date', null)));

			$sw = false;
			$payments = Payment::where('credit_id', $credit_id)->get();

			foreach ($payments as $payment) {
				if ($date == date('Y-m-d', strtotime($payment->date))) {
					$sw = true;
				}

				if ($sw) {
					break;
				}
			}

			if ($sw) {
				$validator->errors()->add('date', 'Ya se realizó un pago para esta fecha.');
			}
		});

		if ($validator->fails()) {
			return redirect()
				->action('CreditController@index')
				->withInput()
				->withErrors($validator->errors());
		}

		if (Credit::find(intval($request->input('credit_id')))->balance() >= intval($request->input('value'))) {
			$payment = new Payment;
			$payment->credit_id	= $request->input('credit_id');
			$payment->value 	= $request->input('value');
			$payment->date		= $request->input('date');
			$payment->save();
		}
		else {
			return redirect()->route('home')->withInput()->with('alert', 'Error: El valor de la cuota supera el saldo de la deuda!');
		}

		return redirect()->action('CreditController@status', ['id' => intval($request->input('credit_id'))]);
	}

	/**
	 * Delete a payment.
	 */
	public function delete($id)
	{
		Payment::destroy($id);

		return redirect()->route('payments')->with('success', 'Exito: Pago eliminado!');
	}

	/**
	 * Update a payment.
	 */
	public function update($id, Request $request)
	{
		//
	}
}
