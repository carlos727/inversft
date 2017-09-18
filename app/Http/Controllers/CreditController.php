<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;

use App\Credit;
use App\Client;
use App\Collector;
use App\Payment;
use Carbon\Carbon;
use Validator;

class CreditController extends Controller
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
	public function index($collector_id = null)
	{
		if ($collector_id === null) {
			$credits = Credit::where('active', 1)->get();
			$name = '';
		}
		else {
			$credits = Credit::where([['collector_id', $collector_id], ['active', 1]])->get();
			$name = 'del cobrador '.Collector::findOrFail($collector_id)->name;
		}

		return view('home',[
			'credits' 	=> $credits,
			'clients' 	=> Client::all(),
			'collectors'=> Collector::where('active', 1)->get(),
			'navbar'	=> ['active', '', ''],
			'name'		=> $name,
			'download'	=> route('download_credits', ['collector_id' => $collector_id])
		]);
	}

	public function create()
	{
		if (Collector::where('active', 1)->isNotEmpty()) {
			return view('credit', [
				'clients'	=> Client::orderBy('name', 'asc')->get(),
				'collectors'=> Collector::where('active', 1)->orderBy('name', 'asc')->get(),
				'navbar'	=> ['active', '', '']
			]);
		}
		else {
			return redirect()->action('CreditController@index')
								->with('alert', 'Error: No hay cobradores habilitados para tener creditos.');
		}
	}

	/**
	 * Store a new credit.
	 */
	public function store(Request $request)
	{
		$regex = "/^\d+((\.|\,)\d+)?$/";

		$validator = Validator::make($request->all(), [
			'collector_id'	=>  'required|numeric|min:1',
			'client_id' 	=>  'required|numeric|min:1',
			'value'			=>	'required|numeric|min:1',
			'fee'			=>	'required|numeric|min:1',
			'type'			=>	'required|digits_between:0,3',
			'revenue'		=>	'required|numeric',//|regex:'.$regex,
			'start_at'		=>	'required|date'
		]);

		if ($validator->fails()) {
			return redirect()
				->action('CreditController@create')
				->withInput()
				->withErrors($validator->errors());
		}

		$client_id = $request->input('client_id');
		$credits = Credit::where('client_id', $client_id)->get();
		$cbefore = false;

		if ($credits->isNotEmpty()) {
			$credit = Credit::where('client_id', $client_id)->orderBy('start_at', 'desc')->first();

			if ($credit->active) {
				$payment = new Payment;
				$payment->credit_id	= $credit->id;
				$payment->value 	= $credit->balance();
				$payment->date		= Carbon::now()->toDateString();
				$payment->save();

				$credit->active = 0;
				$credit->save();

				$cbefore = true;
			}
		}

		$credit = new Credit;
		$credit->client_id    = $client_id;
		$credit->collector_id = $request->input('collector_id');
		$credit->value		  = $request->input('value');
		$credit->fee		  = $request->input('fee');
		$credit->type		  = $request->input('type');
		$credit->revenue	  = $request->input('revenue');
		$credit->start_at	  = $request->input('start_at');
		$credit->save();

		if ($cbefore) {
			return redirect()->action('CreditController@index')
								->with('success', 'Exito: Crédito creado!')
								->with('info', 'Información: Crédito anterior pagado totalmente.');
		}
		else {
			return redirect()->action('CreditController@index')->with('success', 'Exito: Crédito creado!');
		}
	}

	/**
	 * Delete a credit.
	 */
	public function delete($id)
	{
		if (Credit::findOrFail($id)->payments->isEmpty()) {
			Credit::destroy($id);
			return redirect()->action('CreditController@index')->with('success', 'Exito: Crédito eliminado!');
		}
		else {
			return redirect()->action('CreditController@index')->with('alert', 'Error: El crédito tiene pagos asociados.');
		}
	}

	/**
	 * Update a credit.
	 */
	public function update($id, Request $request)
	{
		$credit = Credit::findOrFail($id);

		if ($credit->payments->isEmpty()) {

			$regex = "/^\d+((\.|\,)\d+)?$/";

			$validator = Validator::make($request->all(), [
				'collector_id'	=>  'required|numeric|min:1',
				'client_id' 	=>  'required|numeric|min:1',
				'value'			=>	'required|numeric|min:1',
				'fee'			=>	'required|numeric|min:1',
				'type'			=>	'required|digits_between:0,3',
				'revenue'		=>	'required|numeric',//|regex:'.$regex,
				'start_at'		=>	'required|date'
			]);

			if ($validator->fails()) {
				return redirect()
					->action('CreditController@create')
					->withInput()
					->withErrors($validator->errors());
			}

			$credit->client_id    = $client_id;
			$credit->collector_id = $request->input('collector_id');
			$credit->value		  = $request->input('value');
			$credit->fee		  = $request->input('fee');
			$credit->type		  = $request->input('type');
			$credit->revenue	  = $request->input('revenue');
			$credit->start_at	  = $request->input('start_at');
			$credit->save();

			return redirect()->action('CreditController@index')->with('success', 'Exito: Datos del crédito actualizados!');
		}
		else {
			return redirect()->action('CreditController@index')->with('alert', 'Error: El crédito tiene pagos asociados.');
		}
	}

	public function status($id)
	{
		$credit = Credit::find($id);

		if ($credit->balance() == 0) {
			$credit->active = 0;
			$credit->save();

			return redirect()->route('home')->with('success', 'Exito: Pago realizado.')->with('info', 'Información: Crédito pagado totalmente.');
		}
		else {
			return redirect()->route('home')->with('success', 'Exito: Pago realizado.');
		}
	}

	public function download($collector_id = null)
	{
		if ($collector_id === null) {
			return redirect()->route('home')->with('warning', 'Alerta: Elige un cobrador para completar la acción.');
		}
		else {

			$credits = Collector::findOrFail($collector_id)->credits->where('active', 1);
			$data = [];

			foreach ($credits as $credit) {
				array_push($data, [
					'Nombre'	=> $credit->client->name,
					'Dirección'	=> $credit->client->address,
					'Telefono'	=> $credit->client->phone,
					'Cuota'		=> $credit->fee_val(),
					'Dió'		=> ''
				]);
			}

			Excel::create('Cobro_'.Collector::findOrFail($collector_id)->name, function($excel) use($data) {

			    $excel->sheet('Creditos Activos', function($sheet) use($data) {

					$sheet->fromArray($data);

				});

			})->export('xlsx');
		}
	}
}