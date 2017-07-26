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
        //dd($this->getReceipes('tiramisu'));
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

    private function getReceipes($keyword){

        try{

            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $response = $client->request('GET', "/food/search/".$keyword , [
                'timeout' => 120
            ]);

            if($response->getStatusCode() == 200)
            {
                $response = simplexml_load_string($response->getBody()->getContents());
                $meals = array();
                foreach($response->meal as $meal)
                {
                    //print_r($meal);
                    array_push($meals, array('food_name' => (string)$meal->food_name[0], 'food_description' => (string)$meal->food_description[0], 'food_url' => (string)$meal->food_url[0]));
                    //echo $meal->food_name[0]." | ".$meal->food_description[0]." | ".$meal->food_url[0];
                    //echo '<br><br>';
                }
                return $meals;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            dd($e->getMessage());
        }

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

        if(isset($health) && ($health != 'Select optional preference'))
            $endpoint = $endpoint.'&health='.$health;

        if(isset($diet) && ($diet != 'Select optional preference'))
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
        $recipies2 = $this->getReceipes($keywords);

        return view('recipies', ['recipies' => $recipies, 'recipies2' => $recipies2]);


    }
    catch(GuzzleException $e){

        return '<div class="alert alert-danger" role="alert"><p class="">'.$e->getMessage().'</p></div>';

    }


    }
}
