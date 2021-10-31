<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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
        $response = $client->post(config('app.passport_api'), [
            'grant_type' => 'password',
            'client_id' => config('app.passport_id'),
            'client_secret' => config('app.passport_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);
        return json_decode((string)$response->getContent());
    }
}
