<?php

namespace Helpers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Helper{


public static function fetchQuote() {

	try{

		$endpoint = env('API_QUOTE');
	    $client = new Client();
	    $response = $client->get($endpoint, ['connect_timeout' => 1 , 'verify' => false]);
	    $quote = json_decode($response->getBody()->getContents());

	    if (!(is_null($quote)))
	    {
	    	return trim($quote->quoteText) .' - '. trim($quote->quoteAuthor);
	    }
	    else
	    {

	    	return '<div class="alert alert-danger" role="alert"><p class="">Error reaching external api.</p></div>';
	    }
	    

	}
	catch(GuzzleException $e){

		return '<div class="alert alert-danger" role="alert"><p class="">'.$e->getMessage().'</p></div>'; 		

	}


}

public static function getJavaId()
{
	return \DB::table('user_mapping')->where('user_id_php', \Auth::user()->id)->value('user_id_java');
}

}