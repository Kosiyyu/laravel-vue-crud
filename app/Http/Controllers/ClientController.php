<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Client;

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
        //validation todo

        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    //get
    public function get($id)
    {
        $client = Client::find($id);
        if($client === null){
            return response()->json(404);
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

        //validation todo

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