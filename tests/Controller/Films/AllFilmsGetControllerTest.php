<?php

namespace App\Tests\Controller\Films;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AllFilmsGetControllerTest extends WebTestCase
{
    public function testAllFilms(): void
    {
        $result = $this->whenRequestExecuted();

        $this->thenResponseIsWright($result);
    }

    private function whenRequestExecuted(): array
    {
        $client = self::createClient();
        //$kernel = $this->createKernel();

        //$client = static::createClient();

        $request = $client->getRequest();

        return $request->get('/film');
        //return $client->request('GET','/film');
    }

    private function thenResponseIsWright(array $result): void
    {
        $this->assertResponseIsSuccessful();

        foreach($result as $film){
            $this->assertArrayHasKey('id',$film);
            $this->assertArrayHasKey('title',$film);
            $this->assertArrayHasKey('date',$film);
            $this->assertArrayHasKey('duration',$film);
            $this->assertArrayHasKey('producer',$film);
            $this->assertArrayHasKey('place',$film);
        }
    }
}
