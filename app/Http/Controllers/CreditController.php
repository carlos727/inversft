<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Credit;
use App\Client;
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
    public function index()
    {
        $credits = Credit::where('active', 1)->get();

    	return view('home',[
    		'credits' => $credits
    	]);
    }

    public function create()
    {
        $clients = Client::orderBy('name', 'asc')->get();

        return view('credit',[
            'clients' => $clients
        ]);
    }

    /**
     * Store a new credit.
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'client_id' =>  'required',
    		'value'		=>	'required',
    		'fee'		=>	'required',
    		'type'		=>	'required',
    		'revenue'	=>	'required',
    		'start_at'	=>	'required',
    		'active'	=>	'required'
    	]);

    	if ($validator->fails()) {
    		return redirect()
    			->action('CreditController@index')
    			->withErrors($validator->errors());
    	}

    	$credit = new Credit;
    	$credit->client_id	= $request->input('client_id');
    	$credit->value		= $request->input('value');
    	$credit->fee		= $request->input('fee');
    	$credit->type		= $request->input('type');
    	$credit->revenue	= $request->input('revenue');
    	$credit->start_at	= $request->input('start_at');
    	$credit->active		= 1;
    	$credit->save();

    	return redirect()->action('CreditController@index');
    }

    /**
     * Delete a credit.
     */
    public function delete($id)
    {
		//
	}

	/**
     * Update a credit.
     */
	public function update($id, Request $request)
    {
		//
	}
}
