<?php

use App\Models\Server;
use App\Repositories\ServerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServerRepositoryTest extends TestCase
{
    use MakeServerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ServerRepository
     */
    protected $serverRepo;

    public function setUp()
    {
        parent::setUp();
        $this->serverRepo = App::make(ServerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateServer()
    {
        $server = $this->fakeServerData();
        $createdServer = $this->serverRepo->create($server);
        $createdServer = $createdServer->toArray();
        $this->assertArrayHasKey('id', $createdServer);
        $this->assertNotNull($createdServer['id'], 'Created Server must have id specified');
        $this->assertNotNull(Server::find($createdServer['id']), 'Server with given id must be in DB');
        $this->assertModelData($server, $createdServer);
    }

    /**
     * @test read
     */
    public function testReadServer()
    {
        $server = $this->makeServer();
        $dbServer = $this->serverRepo->find($server->id);
        $dbServer = $dbServer->toArray();
        $this->assertModelData($server->toArray(), $dbServer);
    }

    /**
     * @test update
     */
    public function testUpdateServer()
    {
        $server = $this->makeServer();
        $fakeServer = $this->fakeServerData();
        $updatedServer = $this->serverRepo->update($fakeServer, $server->id);
        $this->assertModelData($fakeServer, $updatedServer->toArray());
        $dbServer = $this->serverRepo->find($server->id);
        $this->assertModelData($fakeServer, $dbServer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteServer()
    {
        $server = $this->makeServer();
        $resp = $this->serverRepo->delete($server->id);
        $this->assertTrue($resp);
        $this->assertNull(Server::find($server->id), 'Server should not exist in DB');
    }
}
