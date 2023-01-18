<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\UserAuthentication;
use App\Repository\UserAuthenticationRepository;
use App\Tests\Api\AbstractRequestTest;

class AuthTest extends AbstractRequestTest
{

    public function testLogin(): void
    {
        $authUserData = [
            'email'=>'test@test.com',
            'password'=>'admin'
        ];
        $response = $this->httpClientRequest('authentication_token', 'POST', $authUserData, false);
        
        $content = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertArrayHasKey('token', $content);
        
        // dd($content);
        // dd($response->toArray());
    }

  
}
