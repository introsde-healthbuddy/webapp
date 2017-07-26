<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SettingsController extends Controller
{
    private function fetchForeignDetails(){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', '/person'.'/'.$foreign_id , [
                'headers' => ['Content-Type' => 'application/xml'],
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $response = simplexml_load_string($response->getBody()->getContents());
                return $response;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

    }

    private function updateForeignDetails(array $data){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);


            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><person></person>');
            $body->addChild('firstname', $data['firstname']);
            $body->addChild('lastname', $data['lastname']);
            $body->addChild('birthdate', $data['birthdate']);
            $body = $body->asXML();

            $response = $client->request('PUT', '/person'.'/'.$foreign_id, [
                'headers' => ['Content-Type' => 'application/xml'],
                'timeout' => 120,
                'body' => $body
            ]);

            if($response->getStatusCode() == 200)
            {
                $response = simplexml_load_string($response->getBody()->getContents());
                return $response;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->fetchForeignDetails();
        return view('settings', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['firstname'] = $request->input('firstname');
        $data['lastname'] = $request->input('lastname');
        $data['birthdate'] = $request->input('birthdate');

        $this->updateForeignDetails($data);

        $user = \App\User::find(\Auth::user()->id);
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
