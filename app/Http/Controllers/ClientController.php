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
	 * Show client list.
	 */
	public function show()
	{
		return view('person_list',[
			'person' => 'clientes',
			'people' => Client::orderBy('name', 'asc')->get(),
			'navbar' => ['', 'active', '']
		]);
	}

	public function create()
	{
		return view('create_person', [
			'route' => 'store_client',
			'person' => 'Cliente',
			'navbar' => ['', 'active', '']
		]);
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

		return redirect()->route('create_credit')->with('success', 'Exito: Cliente creado!')->with('id', intval($request->input('id')));
	}

	/**
	 * Delete a client.
	 */
	public function delete($id)
	{
		$count = Client::findOrFail($id)->credits->count();

		if ($count == 0) {
			Client::findOrFail($id)->delete();
			return redirect()->action('ClientController@show')->with('success', 'Exito: Cliente eliminado!');
		}
		else {
			return redirect()->action('ClientController@show')->with('warning', 'Alerta: El cliente tiene creditos asociados.');
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

		return redirect()->route('list_clients')->with('success', 'Exito: Datos del cliente actualizados!');
	}

	/**
	 * Credit history of a client
	 */
	public function credits($id)
	{
		return view('credits', [
			'credits' => Client::findOrFail($id)->credits
		]);
	}
}