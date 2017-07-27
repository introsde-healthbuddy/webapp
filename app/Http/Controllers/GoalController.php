<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Goal;

class GoalController extends Controller
{
    private function getGoalDetails($id){

        $goals =  $this->getGoals();
        $found = array();

        foreach($goals as $goal){
            if($goal->id == $id)
            {
                $found = $goal;
            }
        }

        return $found;
    }

    private function getGoals(){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', '/goal'.'/'.$foreign_id , [
                'headers' => ['Content-Type' => 'application/xml'],
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $response = simplexml_load_string($response->getBody()->getContents());

                $goals = array();
                foreach($response as $goal)
                {
                    $goals[] = (object)array('id' => (int)$goal->idGoal, 'name' => (string)$goal->name, 'type' => (string)$goal->type, 'deadline' => (string)$goal->deadline, 'is_completed' => (int)$goal->is_completed);
                }

                return $goals;

            }

            dd('Error: '.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

    }

    private function createGoal($data){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><goal></goal>');
            $body->addChild('name', $data['name']);
            $body->addChild('type', $data['type']);
            $body->addChild('deadline', $data['deadline']);
            $body->addChild('is_completed', $data['is_completed']);
            $body = $body->asXML();

            //dd($body);

            $response = $client->request('POST', '/goal'.'/'.$foreign_id, [
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

    private function updateGoal($data){

        try{
            $user = \Auth::user();
            $foreign_id = $user->foreign_id;

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><goal></goal>');
            $body->addChild('idGoal', $data['id']);
            $body->addChild('name', $data['name']);
            $body->addChild('type', $data['type']);
            $body->addChild('deadline', $data['deadline']);
            $body->addChild('is_completed', $data['is_completed']);
            $body = $body->asXML();

            //dd($body);

            $response = $client->request('PUT', '/goal'.'/'.$foreign_id, [
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


    public function index()
    {

        $goals = $this->getGoals();
        //$goals = \DB::select('SELECT * FROM goals WHERE user_id = :user_id ORDER BY expiry', ['user_id' => \Auth::user()->id]);
        return view('goals', ['goals' => $goals]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('goals-create-form');
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
            'deadline' => 'required',
            'is_completed' => 'required'
        ]);

        $input['name'] = $request->input('name');
        $input['type'] = $request->input('type');
        $input['deadline'] = $request->input('deadline');
        $input['is_completed'] = $request->input('is_completed');


        $this->createGoal($input);
        //\App\Goal::create($input);

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('GoalController@index')->with('message', 'Goal successfully created.');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$goal = \App\Goal::find( $id );
        $goal = $this->getGoalDetails($id);
        return view('goals-edit-form', ['goal' => $goal]);
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
            'deadline' => 'required',
            'is_completed' => 'required'
        ]);

        $input['id'] = $id;
        $input['name'] = $request->input('name');
        $input['type'] = $request->input('type');
        $input['deadline'] = $request->input('deadline');
        $input['is_completed'] = $request->input('is_completed');

        $this->updateGoal($input);

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('GoalController@index')->with('message', 'Goal updated deleted.');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goal = \App\Goal::find( $id );
        $goal->delete();

        \Session::flash('alert-class', 'alert-success');
        return \Redirect::action('GoalController@index')->with('message', 'Goal successfully deleted.');
    }
}
