<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    //getAll
    public function getAll()
    {
        return response()->json(Client::all(), 200);
    }

    //create
    public function create(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:clients',
            'telephone_number' => 'required|unique:clients',
        ]);
        if ($validatedData->fails())
        {
            return response()->json($validatedData->errors(), 400);
        }

        $client = new Client;
        $client->firstname = $request->input('firstname');
        $client->lastname = $request->input('lastname');
        $client->email = $request->input('email');
        $client->telephone_number = $request->input('telephone_number');

        $client->save();

        return response()->json($client, 201);
    }

    //get
    public function get($id)
    {
        $client = Client::find($id);
        if($client === null){
            return response()->json(null, 404);
        }

        return response()->json($client, 200);
    }

    //update
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if($client === null)
        {
            return response()->json(null, 404);
        }

        $validatedData = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:clients,email,'.$id,
            'telephone_number' => 'required|unique:clients,telephone_number,'.$id,
        ]);
        if ($validatedData->fails())
        {
            return response()->json($validatedData->errors(), 400);
        }

        $client->firstname = $request->input('firstname');
        $client->lastname = $request->input('lastname');
        $client->email = $request->input('email');
        $client->telephone_number = $request->input('telephone_number');

        $client->save();

        return response()->json($client, 200);
    }

    //delete
    public function delete($id)
    {
        $client = Client::find($id);
        if($client === null){
            return response()->json(204);
        }

        $client->delete();

        return response()->json(null, 200);
    }
}
