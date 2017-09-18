<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Collector;
use Validator;

class CollectorController extends Controller
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
	 * Show collector list.
	 */
	public function show()
	{
		return view('person_list',[
			'person' => 'cobradores',
			'people' => Collector::orderBy('name', 'asc')->get(),
			'navbar' => ['', '', 'active']
		]);
	}

	public function create()
	{
		return view('create_person', [
			'route' => 'store_collector',
			'person' => 'Cobrador',
			'navbar' => ['', '', 'active']
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
				->action('CollectorController@create')
				->withInput()
				->withErrors($validator->errors());
		}

		$client = new Collector;
		$client->id 	= $request->input('id');
		$client->name	= $request->input('name');
		$client->address= $request->input('address');
		$client->phone	= $request->input('phone');
		$client->save();

		return redirect()->route('list_collectors')
							->with('success', 'Exito: Cobrador creado!')
							->with('id', intval($request->input('id')));
	}

	/**
	 * Delete a client.
	 */
	public function delete($id)
	{
		$count = Collector::findOrFail($id)->credits->count();

		if ($count == 0) {
			Collector::findOrFail($id)->delete();
			return redirect()->action('CollectorController@show')->with('success', 'Exito: Cobrador eliminado!');
		}
		else {
			return redirect()->action('CollectorController@show')
								->with('alert', 'Error: El cobrador tiene creditos asociados.');
		}
	}

	/**
	 * Update a client.
	 */
	public function update($id, Request $request)
	{
		$collector = Collector::findOrFail($id);
		$fields = [];

		if ($request->input('address_check')) {
			$fields['address'] = 'required|string|max:50';
		}

		if ($request->input('phone_check')) {
			$fields['phone'] = 'required|numeric';
		}

		$validator = Validator::make($request->all(), $fields);

		if ($request->input('phone_check')) {
			$validator->after(function ($validator) {

				$phone = array_get($validator->getData(), 'phone', null);

				if (!(strlen($phone) == 7 || strlen($phone) == 10)) {
					$validator->errors()->add('phone', 'Formato de numero telefonico incorrecto.');
				}

			});
		}

		if ($validator->fails()) {
			return redirect()
				->action('CollectorController@show')
				->withInput()
				->withErrors($validator->errors());
		}

		if ($request->input('address_check')) {
			$collector->address= $request->input('address');
		}

		if ($request->input('phone_check')) {
			$collector->phone	= $request->input('phone');
		}

		$collector->save();

		if ($request->input('address_check') || $request->input('phone_check')) {
			return redirect()->route('list_collectors')->with('success', 'Exito: Datos del cobrador actualizados!');
		} else {
			return redirect()->route('list_collectors');
		}

	}

	/**
	 * Credits of a collector
	 */
	public function credits($id)
	{
		return redirect()->action('CreditController@index', ['$collector_id' => $id]);
	}

	/**
	 * Change status of a collector
	 */
	public function change_status($id)
	{
		$collector = Collector::findOrFail($id);

		if ($collector->credits->where('active', 1)->count() > 0) {
			return redirect()->action('CollectorController@show')
								->with('alert', 'Error: El cobrador tiene creditos asociados.');
		}

		$collector->active = !$collector->active;
		$collector->save();

		return redirect()->route('list_collectors')->with('success', 'Exito: Estado del cobrador actualizado!');
	}
}
