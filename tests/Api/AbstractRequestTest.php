<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\Class\Interfaces\RequestTestInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

abstract class AbstractRequestTest extends ApiTestCase
{
    protected Client $httpClient;
    protected string $token = '';

    public function httpClientRequest(string $pathUrl, string $method ,array $bodyRequest = [], bool $needAuthToken = false) 
    {
        $this->httpClient = static::createClient();

        $url = 'http://127.0.0.1:8000/';    
         try {
             $response = $this->httpClient->request( $method , $url . $pathUrl, [
                     'headers' => [
                         'accept' => 'application/json',
                         'Authorization' => $needAuthToken ? 'Bearer ' . $this->getToken() : '',
                         'Content-Type' => 'application/json',
                     ],
                     'body' => json_encode($bodyRequest)
             ]);
            return $response;

         } catch (\Exception $e) {
            dd($e);
         }
    }
    public function getToken():string
    {
        if ($this->token) {
            return $this->token;
        } else {
            $authUserData = [
                'email'=>'test@test.com',
                'password'=>'admin'
            ];
            $response = $this->httpClientRequest('authentication_token','POST' , $authUserData, false);
            $content = $response->getContent();
            $content = $response->toArray();
            $this->token = $content['token'];
            return $this->token;
        }
    }
}