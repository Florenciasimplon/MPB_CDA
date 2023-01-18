<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\UserAuthentication;
use App\Repository\UserAuthenticationRepository;
use App\Tests\Api\AbstractRequestTest;

class ArticleTest extends AbstractRequestTest
{
    public function testGetArticleCollection(): void
    {
        $response = $this->httpClientRequest('api/articles', 'GET',  [], true);
        $content = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($content[0]['id'], 1);
        $this->assertEquals($content[0]['title'], "A Dad’s Guide to Pregnancy");
    }
}
