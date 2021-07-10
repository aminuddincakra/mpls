<?php

use App\Models\Pengumuman;
use App\Repositories\PengumumanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PengumumanRepositoryTest extends TestCase
{
    use MakePengumumanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PengumumanRepository
     */
    protected $pengumumanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pengumumanRepo = App::make(PengumumanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePengumuman()
    {
        $pengumuman = $this->fakePengumumanData();
        $createdPengumuman = $this->pengumumanRepo->create($pengumuman);
        $createdPengumuman = $createdPengumuman->toArray();
        $this->assertArrayHasKey('id', $createdPengumuman);
        $this->assertNotNull($createdPengumuman['id'], 'Created Pengumuman must have id specified');
        $this->assertNotNull(Pengumuman::find($createdPengumuman['id']), 'Pengumuman with given id must be in DB');
        $this->assertModelData($pengumuman, $createdPengumuman);
    }

    /**
     * @test read
     */
    public function testReadPengumuman()
    {
        $pengumuman = $this->makePengumuman();
        $dbPengumuman = $this->pengumumanRepo->find($pengumuman->id);
        $dbPengumuman = $dbPengumuman->toArray();
        $this->assertModelData($pengumuman->toArray(), $dbPengumuman);
    }

    /**
     * @test update
     */
    public function testUpdatePengumuman()
    {
        $pengumuman = $this->makePengumuman();
        $fakePengumuman = $this->fakePengumumanData();
        $updatedPengumuman = $this->pengumumanRepo->update($fakePengumuman, $pengumuman->id);
        $this->assertModelData($fakePengumuman, $updatedPengumuman->toArray());
        $dbPengumuman = $this->pengumumanRepo->find($pengumuman->id);
        $this->assertModelData($fakePengumuman, $dbPengumuman->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePengumuman()
    {
        $pengumuman = $this->makePengumuman();
        $resp = $this->pengumumanRepo->delete($pengumuman->id);
        $this->assertTrue($resp);
        $this->assertNull(Pengumuman::find($pengumuman->id), 'Pengumuman should not exist in DB');
    }
}
