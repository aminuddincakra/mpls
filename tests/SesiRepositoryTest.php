<?php

use App\Models\Sesi;
use App\Repositories\SesiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SesiRepositoryTest extends TestCase
{
    use MakeSesiTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SesiRepository
     */
    protected $sesiRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sesiRepo = App::make(SesiRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSesi()
    {
        $sesi = $this->fakeSesiData();
        $createdSesi = $this->sesiRepo->create($sesi);
        $createdSesi = $createdSesi->toArray();
        $this->assertArrayHasKey('id', $createdSesi);
        $this->assertNotNull($createdSesi['id'], 'Created Sesi must have id specified');
        $this->assertNotNull(Sesi::find($createdSesi['id']), 'Sesi with given id must be in DB');
        $this->assertModelData($sesi, $createdSesi);
    }

    /**
     * @test read
     */
    public function testReadSesi()
    {
        $sesi = $this->makeSesi();
        $dbSesi = $this->sesiRepo->find($sesi->id);
        $dbSesi = $dbSesi->toArray();
        $this->assertModelData($sesi->toArray(), $dbSesi);
    }

    /**
     * @test update
     */
    public function testUpdateSesi()
    {
        $sesi = $this->makeSesi();
        $fakeSesi = $this->fakeSesiData();
        $updatedSesi = $this->sesiRepo->update($fakeSesi, $sesi->id);
        $this->assertModelData($fakeSesi, $updatedSesi->toArray());
        $dbSesi = $this->sesiRepo->find($sesi->id);
        $this->assertModelData($fakeSesi, $dbSesi->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSesi()
    {
        $sesi = $this->makeSesi();
        $resp = $this->sesiRepo->delete($sesi->id);
        $this->assertTrue($resp);
        $this->assertNull(Sesi::find($sesi->id), 'Sesi should not exist in DB');
    }
}
