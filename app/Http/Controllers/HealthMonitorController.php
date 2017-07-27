<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HealthMonitorController extends Controller
{
    private function logMeasure($data){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><activity></activity>');
            $body->addChild('measureType', $data['healthmeasure']);
            $body->addChild('measureValue', $data['value']);
            $body->addChild('dateRegistered', $data['date']);
            $body = $body->asXML();

            //dd($body);

            $response = $client->request('POST', '/measure'.'/'.$foreign_id, [
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

    private function getHealthMeasures(){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');
            //$endpoint = 'http://10.218.204.126:5700/';

            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', '/person'.'/'.$foreign_id , [
                'headers' => ['Content-Type' => 'application/xml'],
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $response = simplexml_load_string($response->getBody()->getContents());


                $all_measures = array();

                foreach($response->currentHealth->measure as $measure)
                {
                    //dd($measure);
                    $all_measures[] = (string)$measure->measureType;
                }

                return $all_measures;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }


    }

    private function getHeathMeasureData($measure){

        try{

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');
            //$endpoint = 'http://10.218.204.126:5700/';
            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', "/measure/history/1/".$measure , [
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $measures = simplexml_load_string($response->getBody()->getContents());

                $timeSeries = array();
                $valueSeries = array();

                foreach ($measures as $measure) {

                    $timeSeries[] = "'".(string)$measure->dateRegistered."'";
                    $valueSeries[] = (string)$measure->measureValue;

                }

                $data['timeSeries'] = $timeSeries;
                $data['valueSeries'] = $valueSeries;

                return $data;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

    }

    private function getHeathMeasureDataAssoc($measure){

        try{

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');
            //$endpoint = 'http://10.218.204.126:5700/';
            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', "/measure/history/1/".$measure , [
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $measures = simplexml_load_string($response->getBody()->getContents());

                $records = array();

                foreach ($measures as $m) {

                    //$records[] = "'".(string)$m->dateRegistered."'";
                    //$records[] = (string)$m->measureValue;

                    $records[] = (object)array('id' => (int)$m->idMeasure, 'measure' => (string)$m->measureType, 'value' => (string)$m->measureValue, 'date' => (string)$m->dateRegistered);

                }

                return $records;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

    }

    private function getMeasureDetails($id, $measure){

        try{

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');
            //$endpoint = 'http://10.218.204.126:5700/';
            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', "/measure/history/1/".$measure , [
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $measures = simplexml_load_string($response->getBody()->getContents());

                $records = array();

                foreach ($measures as $m) {

                    //$records[] = "'".(string)$m->dateRegistered."'";
                    //$records[] = (string)$m->measureValue;
                    if((int)$m->idMeasure == $id)
                    {
                        $records[] = (object)array('id' => (int)$m->idMeasure, 'measure' => (string)$m->measureType, 'value' => (string)$m->measureValue, 'date' => (string)$m->dateRegistered);
                    }



                }

                return $records;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

    }

    private function updateMeasure($data){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><measure></measure>');
            $body->addChild('idMeasure', $data['id']);
            $body->addChild('measureType', $data['healthmeasure']);
            $body->addChild('measureValue', $data['value']);
            $body->addChild('dateRegistered', $data['date']);
            $body = $body->asXML();

            //dd($body);

            $response = $client->request('PUT', '/measure'.'/'.$foreign_id, [
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
        $measures = $this->getHealthMeasures();
        $data = array();

        foreach ($measures as $measure){

            $data[$measure] = $this->getHeathMeasureData($measure);

        }

        //dd($weight);
        return view('health-monitor', ['data' => $data]);
    }

    public function table()
    {
        //$data['measures'] = $this->getAllHealthMeasureData();

        $measures = $this->getHealthMeasures();
        $data = array();

        foreach ($measures as $measure){

            $data[] = $this->getHeathMeasureDataAssoc($measure);

        }

        $data = array_flatten($data);
        //dd($data);
        return view('health-monitor-table', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $measures = $this->getHealthMeasures();
        return view('health-monitor-create-form', ['measures' => $measures]);
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

            'healthmeasure' => 'required',
            'value' => 'required',
            'date' => 'required',
        ]);

        $input['healthmeasure'] = $request->input('healthmeasure');
        $input['value'] = $request->input('value');
        $input['date'] = $request->input('date');

        $this->logMeasure($input);

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('HealthMonitorController@index')->with('message', 'Health Mesure logged successfully.');
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
        // $id = $request->input('id');
        // $measure = $request->input('measure');
        //
        // $measure = $this->getMeasureDetails($id, $measure);
        // dd($measure);
        //
        // return view('measure-edit-form', ['measure' => $measure]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cedit(Request $request)
    {
        $id = $request->input('id');
        $measure = $request->input('measure');

        $measure = $this->getMeasureDetails($id, $measure);
        $measure = array_flatten($measure);
        //dd($measure);

        return view('health-monitor-edit-form', ['measure' => $measure]);
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

            'healthmeasure' => 'required',
            'value' => 'required',
            'date' => 'required'
        ]);

        $input['id'] = $id;
        $input['healthmeasure'] = $request->input('healthmeasure');
        $input['value'] = $request->input('value');
        $input['date'] = $request->input('date');

        $this->updateMeasure($input);

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('HealthMonitorController@table')->with('message', 'Measure updated successfully.');
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
