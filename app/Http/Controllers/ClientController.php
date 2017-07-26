<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Client;
use Validator;

class ClientController extends Controller
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
		return view('clients',[
			'clients' => Client::orderBy('name', 'asc')->get()
		]);
	}

	public function create()
	{
		return view('client');
	}

	/**
	 * Store a new client.
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id'		=>	'required|numeric|min:1|unique:clients',
			'name'		=>	'required|string|max:50',
			'address'	=>	'required|string|max:50',
			'phone'		=>	'required|numeric'
		]);

		$validator->after(function ($validator) {

			$phone = array_get($validator->getData(), 'phone', null);

			if (!(strlen($phone) == 7 || strlen($phone) == 10)) {
				$validator->errors()->add('phone', 'Formato de numero telefonico incorrecto.');
			}

		});

		if ($validator->fails()) {
			return redirect()
				->action('ClientController@create')
				->withInput()
				->withErrors($validator->errors());
		}

		$client = new Client;
		$client->id 	= $request->input('id');
		$client->name	= $request->input('name');
		$client->address= $request->input('address');
		$client->phone	= $request->input('phone');
		$client->save();

		return redirect()->route('create_credit')->with('message', 'Exito: Cliente creado!');
	}

	/**
	 * Delete a client.
	 */
	public function delete($id)
	{
		$count = Client::findOrFail($id)->credits->count();

		if ($count == 0) {
			Client::findOrFail($id)->delete();
			return redirect()->action('ClientController@show')->with('message', 'Exito: Cliente eliminado!');
		}
		else {
			return redirect()->action('ClientController@show')->with('alert', 'Error: El cliente tiene creditos asociados.');
		}
	}

	/**
	 * Update a client.
	 */
	public function update($id, Request $request)
	{
		$client = Client::findOrFail($id);

		$validator = Validator::make($request->all(), [
			'address'	=>	'required|string|max:50',
			'phone'		=>	'required|numeric'
		]);

		$validator->after(function ($validator) {

			$phone = array_get($validator->getData(), 'phone', null);

			if (!(strlen($phone) == 7 || strlen($phone) == 10)) {
				$validator->errors()->add('phone', 'Formato de numero telefonico incorrecto.');
			}

		});

		if ($validator->fails()) {
			return redirect()
				->action('ClientController@show')
				->withInput()
				->withErrors($validator->errors());
		}

		$client->address= $request->input('address');
		$client->phone	= $request->input('phone');
		$client->save();

		return redirect()->route('clients')->with('message', 'Exito: Datos del cliente actualizados!');
	}

	/**
	 *
	 */
	public function credits($id)
	{
		$credits = Client::findOrFail($id)->credits;

		return view('credits', [
			'credits' => $credits
		]);
	}
}