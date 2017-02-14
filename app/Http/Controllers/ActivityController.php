<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $endpoint = env('API_ACTIVITY');
        // $client = new Client();
        // $response = $client->get($endpoint, ['headers' => ['Accept' => 'application/json']]);
        // $activities = json_decode($response->getBody()->getContents());
        // return view('activities', ['activities' => $activities]);

        $activities = \DB::select('SELECT * FROM activities WHERE user_id = :user_id ORDER BY expiry', ['user_id' => \Auth::user()->id]);
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
            'description' => 'required',
            'area' => 'required',
            'expiry' => 'required',
            'completed' => 'required'
        ]);

        $input['name'] = $request->input('name');
        $input['type'] = $request->input('type');
        $input['description'] = $request->input('description');
        $input['area'] = $request->input('area');
        $input['expiry'] = $request->input('expiry');
        $input['completed'] = $request->input('completed');
        $input['user_id'] = \Auth::user()->id;



        \App\Activity::create($input);

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
        $activity = \App\Activity::find( $id );
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
            'description' => 'required',
            'expiry' => 'required',
            'area' => 'required',
            'completed' => 'required'
        ]);

        $activity = \App\Activity::find( $id );

        $activity->name = $request->input('name');
        $activity->type = $request->input('type');
        $activity->description = $request->input('description');
        $activity->expiry = $request->input('expiry');
        $activity->area = $request->input('area');
        $activity->completed = $request->input('completed');
        $activity->user_id = \Auth::user()->id;

        $activity->save();

        \Session::flash('alert-class', 'alert-success'); 
        return \Redirect::action('ActivityController@index')->with('message', 'Activity updated deleted.'); 
        
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
