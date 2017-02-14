<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthMonitorController extends Controller
{
    private function getHealthMeasures()
    {
        try{

            $userId = \DB::table('user_mapping')->where('user_id_php', \Auth::user()->id)->value('user_id_java');;

            $endpoint = 'https://healthbuddy-businesslogic.herokuapp.com/introsde/businessLogic/getHealthMeasures';
            $client = new Client();
            $response = $client->get($endpoint);

            $goals = json_decode($response->getBody()->getContents());
            //dd($goals);
            return $goals;

        }
        catch(GuzzleException $e){

            \Session::flash('message', $e->getMessage()); 
            \Session::flash('alert-class', 'alert-danger'); 

           return false;
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('health-monitor');
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
        //
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
