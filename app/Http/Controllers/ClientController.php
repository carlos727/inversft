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
		//
	}

	/**
	 *
	 */
	public function credits($id)
	{
		$credits = Client::findOrFail($id)->credits()->get();

		return view('credits', [
			'credits' => $credits
		]);
	}
}