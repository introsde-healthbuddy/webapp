<?php

namespace Helpers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Helper{


public static function fetchQuote() {

	$endpoint = env('API_QUOTE');
    $client = new Client();
    $response = $client->get($endpoint);
    $quote = json_decode($response->getBody()->getContents());

   	//dd($quote);
    //return view('activities', ['activities' => $activities]);
    return trim($quote->quoteText) .' - '. trim($quote->quoteAuthor);
}

}