<?php

use App\Models\Kelas;
use App\Repositories\KelasRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KelasRepositoryTest extends TestCase
{
    use MakeKelasTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KelasRepository
     */
    protected $kelasRepo;

    public function setUp()
    {
        parent::setUp();
        $this->kelasRepo = App::make(KelasRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKelas()
    {
        $kelas = $this->fakeKelasData();
        $createdKelas = $this->kelasRepo->create($kelas);
        $createdKelas = $createdKelas->toArray();
        $this->assertArrayHasKey('id', $createdKelas);
        $this->assertNotNull($createdKelas['id'], 'Created Kelas must have id specified');
        $this->assertNotNull(Kelas::find($createdKelas['id']), 'Kelas with given id must be in DB');
        $this->assertModelData($kelas, $createdKelas);
    }

    /**
     * @test read
     */
    public function testReadKelas()
    {
        $kelas = $this->makeKelas();
        $dbKelas = $this->kelasRepo->find($kelas->id);
        $dbKelas = $dbKelas->toArray();
        $this->assertModelData($kelas->toArray(), $dbKelas);
    }

    /**
     * @test update
     */
    public function testUpdateKelas()
    {
        $kelas = $this->makeKelas();
        $fakeKelas = $this->fakeKelasData();
        $updatedKelas = $this->kelasRepo->update($fakeKelas, $kelas->id);
        $this->assertModelData($fakeKelas, $updatedKelas->toArray());
        $dbKelas = $this->kelasRepo->find($kelas->id);
        $this->assertModelData($fakeKelas, $dbKelas->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKelas()
    {
        $kelas = $this->makeKelas();
        $resp = $this->kelasRepo->delete($kelas->id);
        $this->assertTrue($resp);
        $this->assertNull(Kelas::find($kelas->id), 'Kelas should not exist in DB');
    }
}
