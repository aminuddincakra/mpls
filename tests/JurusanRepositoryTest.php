<?php

use App\Models\Jurusan;
use App\Repositories\JurusanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JurusanRepositoryTest extends TestCase
{
    use MakeJurusanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var JurusanRepository
     */
    protected $jurusanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->jurusanRepo = App::make(JurusanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateJurusan()
    {
        $jurusan = $this->fakeJurusanData();
        $createdJurusan = $this->jurusanRepo->create($jurusan);
        $createdJurusan = $createdJurusan->toArray();
        $this->assertArrayHasKey('id', $createdJurusan);
        $this->assertNotNull($createdJurusan['id'], 'Created Jurusan must have id specified');
        $this->assertNotNull(Jurusan::find($createdJurusan['id']), 'Jurusan with given id must be in DB');
        $this->assertModelData($jurusan, $createdJurusan);
    }

    /**
     * @test read
     */
    public function testReadJurusan()
    {
        $jurusan = $this->makeJurusan();
        $dbJurusan = $this->jurusanRepo->find($jurusan->id);
        $dbJurusan = $dbJurusan->toArray();
        $this->assertModelData($jurusan->toArray(), $dbJurusan);
    }

    /**
     * @test update
     */
    public function testUpdateJurusan()
    {
        $jurusan = $this->makeJurusan();
        $fakeJurusan = $this->fakeJurusanData();
        $updatedJurusan = $this->jurusanRepo->update($fakeJurusan, $jurusan->id);
        $this->assertModelData($fakeJurusan, $updatedJurusan->toArray());
        $dbJurusan = $this->jurusanRepo->find($jurusan->id);
        $this->assertModelData($fakeJurusan, $dbJurusan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteJurusan()
    {
        $jurusan = $this->makeJurusan();
        $resp = $this->jurusanRepo->delete($jurusan->id);
        $this->assertTrue($resp);
        $this->assertNull(Jurusan::find($jurusan->id), 'Jurusan should not exist in DB');
    }
}
