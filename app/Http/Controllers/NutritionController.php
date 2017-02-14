<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class NutritionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nutrition');
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

    public function search(Request $request)
    {
        $endpoint = 'https://api.edamam.com/search?q=';
        $appId = 'd6fcb2b7';
        $appKey = '5052acc972ea39d3d18f79b3c5924024';

        $keywords = $request->input('keywords');
        $health = $request->input('heath');
        $diet = $request->input('diet');

        $endpoint = $endpoint.$keywords.'&app_id='.$appId.'&app_key='.$appKey.'&from0&to=10';

        if(isset($health))
            $endpoint = $endpoint.'&health='.$health;

        if(isset($diet))
            $endpoint = $endpoint.'&diet='.$diet;



        //$endpoint = $endpoint.$keywords.'&app_id='.$appId.'&app_key='.$appKey.'&from0&to=10&health='.$health.'&diet='.$diet;
        //$endpoint = 'https://api.edamam.com/search?q=chicken&app_id=d6fcb2b7&app_key=5052acc972ea39d3d18f79b3c5924024&from=0&to=10&health=alcohol-free'

        try{

        //$endpoint = env('API_QUOTE');
        $client = new Client();
        $response = $client->get($endpoint, ['connect_timeout' => 1]);
        $result = json_decode($response->getBody()->getContents());

        //dd($result);

        $recipies = $result->hits;

        return view('recipies', ['recipies' => $recipies]);
        

    }
    catch(GuzzleException $e){

        return '<div class="alert alert-danger" role="alert"><p class="">'.$e->getMessage().'</p></div>';       

    }


    }
}
