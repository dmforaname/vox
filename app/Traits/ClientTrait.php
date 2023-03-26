<?php

namespace App\Traits;

use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Client Trait
|--------------------------------------------------------------------------
|
| 
|
*/

trait ClientTrait
{
	protected function client()
	{
        return new Client([
            'allow_redirects' => false,
            'http_errors' => false,
        ]);
    }

    protected function clientAuth($token)
    {
        return new Client([
            'allow_redirects' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => $token
            ]
        ]);
    }
}