<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Goal;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function getGoals()
    {
        try{

            $userId = \DB::table('user_mapping')->where('user_id_php', \Auth::user()->id)->value('user_id_java');;

            $endpoint = 'https://healthbuddy-businesslogic.herokuapp.com/introsde/businessLogic/getGoals';
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


    public function index()
    {

        $goals = \DB::select('SELECT * FROM goals WHERE user_id = :user_id ORDER BY expiry', ['user_id' => \Auth::user()->id]);
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
            'description' => 'required',
            'expiry' => 'required',
            'completed' => 'required'
        ]);

        $input['name'] = $request->input('name');
        $input['type'] = $request->input('type');
        $input['description'] = $request->input('description');
        $input['expiry'] = $request->input('expiry');
        $input['completed'] = $request->input('completed');
        $input['user_id'] = \Auth::user()->id;



        \App\Goal::create($input);

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
        $goal = \App\Goal::find( $id );
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
            'description' => 'required',
            'expiry' => 'required',
            'completed' => 'required'
        ]);

        $goal = \App\Goal::find( $id );

        $goal->name = $request->input('name');
        $goal->type = $request->input('type');
        $goal->description = $request->input('description');
        $goal->expiry = $request->input('expiry');
        $goal->completed = $request->input('completed');
        $goal->user_id = \Auth::user()->id;

        $goal->save();

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
