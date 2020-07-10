<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServerApiTest extends TestCase
{
    use MakeServerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateServer()
    {
        $server = $this->fakeServerData();
        $this->json('POST', '/api/v1/servers', $server);

        $this->assertApiResponse($server);
    }

    /**
     * @test
     */
    public function testReadServer()
    {
        $server = $this->makeServer();
        $this->json('GET', '/api/v1/servers/'.$server->id);

        $this->assertApiResponse($server->toArray());
    }

    /**
     * @test
     */
    public function testUpdateServer()
    {
        $server = $this->makeServer();
        $editedServer = $this->fakeServerData();

        $this->json('PUT', '/api/v1/servers/'.$server->id, $editedServer);

        $this->assertApiResponse($editedServer);
    }

    /**
     * @test
     */
    public function testDeleteServer()
    {
        $server = $this->makeServer();
        $this->json('DELETE', '/api/v1/servers/'.$server->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/servers/'.$server->id);

        $this->assertResponseStatus(404);
    }
}
