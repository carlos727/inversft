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
        $clients = Client::orderBy('name', 'asc')->get();

    	return view('clients',[
    		'clients' => $clients
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
    		'id'		=>	'required|integer',
    		'name'		=>	'required|string',
    		'address'	=>	'required|string',
    		'phone'		=>	'required|integer'
    	]);

    	if ($validator->fails()) {
    		return redirect()
    			->action('ClientController@create')
    			->withErrors($validator->errors());
    	}

    	$client = new Client;
    	$client->id 	= $request->input('id');
    	$client->name	= $request->input('name');
    	$client->address= $request->input('address');
    	$client->phone	= $request->input('phone');
    	$client->save();

    	return redirect()->action('ClientController@show');
    }

    /**
     * Delete a client.
     */
    public function delete($id)
    {
		//
	}

	/**
     * Update a client.
     */
	public function update($id, Request $request)
	{
		//
	}

    /**
     * Show the application index.
     */
	public function credits($id)
	{
		$credits = Client::findOrFail($id)->credits()->get();

		return view('credits', [
			'credits' => $credits
		]);
	}
}
