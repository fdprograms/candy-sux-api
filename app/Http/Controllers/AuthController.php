<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * login.
     *
     * @param  Request $request
     *
     * @return void
     */
    public function login(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->post(config('app.passport_api'), [
                'json' => [
                    'grant_type' => 'password',
                    'client_id' => config('app.passport_id'),
                    'client_secret' => config('app.passport_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ]
            ]);
            return json_decode((string)$response->getBody());
        } catch (ClientException $e) {
            return response(Psr7\Message::toString($e->getResponse()), 400);
        }
    }
}
