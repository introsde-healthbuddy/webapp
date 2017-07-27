<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ActivityController extends Controller
{
    private function getActivityDetails($id){

        $activities =  $this->getActivities();
        $found = array();

        foreach($activities as $activity){
            if($activity->id == $id)
            {
                $found = $activity;
            }
        }

        return $found;
    }

    private function getActivities(){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', '/activity'.'/'.$foreign_id , [
                'headers' => ['Content-Type' => 'application/xml'],
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $response = simplexml_load_string($response->getBody()->getContents());

                $activities = array();
                foreach($response as $activity)
                {
                    $activities[] = (object)array('id' => (int)$activity->idActivity, 'name' => (string)$activity->name, 'type' => (string)$activity->type, 'date' => (string)$activity->date, 'is_completed' => (int)$activity->is_completed);
                }

                return $activities;

            }

            dd('Error: '.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

    }

    private function createActivity($data){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><activity></activity>');
            $body->addChild('name', $data['name']);
            $body->addChild('type', $data['type']);
            $body->addChild('date', $data['date']);
            $body->addChild('is_completed', $data['is_completed']);
            $body = $body->asXML();

            //dd($body);

            $response = $client->request('POST', '/activity'.'/'.$foreign_id, [
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

    private function updateActivity($data){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><activity></activity>');
            $body->addChild('idActivity', $data['id']);
            $body->addChild('name', $data['name']);
            $body->addChild('type', $data['type']);
            $body->addChild('date', $data['date']);
            $body->addChild('is_completed', $data['is_completed']);
            $body = $body->asXML();

            //dd($body);

            $response = $client->request('PUT', '/activity'.'/'.$foreign_id, [
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
        $activities = $this->getActivities();
        //$activities = \DB::select('SELECT * FROM activities WHERE user_id = :user_id ORDER BY expiry', ['user_id' => \Auth::user()->id]);
        return view('activities', ['activities' => $activities]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity-create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'is_completed' => 'required'
        ]);

        $input['name'] = $request->input('name');
        $input['type'] = $request->input('type');
        $input['date'] = $request->input('date');
        $input['is_completed'] = $request->input('is_completed');

        $this->createActivity($input);



        //\App\Activity::create($input);

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('ActivityController@index')->with('message', 'Activity successfully created.');
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
        $activity = $this->getActivityDetails($id);
        //$activity = \App\Activity::find( $id );
        return view('activity-edit-form', ['activity' => $activity]);
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
        $this->validate($request, [

            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'is_completed' => 'required'
        ]);

        $input['id'] = $id;
        $input['name'] = $request->input('name');
        $input['type'] = $request->input('type');
        $input['date'] = $request->input('date');
        $input['is_completed'] = $request->input('is_completed');

        // $activity = \App\Activity::find( $id );
        //
        // $activity->name = $request->input('name');
        // $activity->type = $request->input('type');
        // $activity->description = $request->input('description');
        // $activity->expiry = $request->input('expiry');
        // $activity->area = $request->input('area');
        // $activity->completed = $request->input('completed');
        // $activity->user_id = \Auth::user()->id;
        //
        // $activity->save();

        $this->updateActivity($input);

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('ActivityController@index')->with('message', 'Activity updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = \App\Activity::find( $id );
        $activity->delete();

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('ActivityController@index')->with('message', 'Activity successfully deleted.');
    }
}
