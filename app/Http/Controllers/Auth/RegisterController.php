<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/health-monitor';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'birthdate' => 'required'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //dd($data);

        /* send a post request to heroku process centric and get new person id */
        $foreign_id = $this->createForeignUser($data);

        if(is_int($foreign_id))
        {
            return User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'foreign_id' => $foreign_id
            ]);

        }

        abort(403, 'Error :'.$foreign_id);


    }

    public function createForeignUser(array $data)
    {
        try{
            $endpoint = env('PROCESS_CENTRIC_ENDPOINT');

            $client = new Client(['base_uri' => $endpoint]);

            $body = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><person></person>');
            $body->addChild('firstname', $data['firstname']);
            $body->addChild('lastname', $data['lastname']);
            $body->addChild('email', $data['email']);
            $body->addChild('birthdate', $data['birthdate']);
            $body = $body->asXML();

            $response = $client->request('POST', '/person', [
                'headers' => ['Content-Type' => 'application/xml'],
                'timeout' => 120,
                'body' => $body
            ]);

            if($response->getStatusCode() == 200)
            {
                $response = simplexml_load_string($response->getBody()->getContents());
                return (int)$response->idPerson;
            }

            dd('Error: '.$response);
            //abort(403, 'Error :'.$response);
        }
        catch(GuzzleException $e){
            return $e->getMessage();
        }

    }
}
