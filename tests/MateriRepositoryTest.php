<?php

use App\Models\Materi;
use App\Repositories\MateriRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MateriRepositoryTest extends TestCase
{
    use MakeMateriTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MateriRepository
     */
    protected $materiRepo;

    public function setUp()
    {
        parent::setUp();
        $this->materiRepo = App::make(MateriRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMateri()
    {
        $materi = $this->fakeMateriData();
        $createdMateri = $this->materiRepo->create($materi);
        $createdMateri = $createdMateri->toArray();
        $this->assertArrayHasKey('id', $createdMateri);
        $this->assertNotNull($createdMateri['id'], 'Created Materi must have id specified');
        $this->assertNotNull(Materi::find($createdMateri['id']), 'Materi with given id must be in DB');
        $this->assertModelData($materi, $createdMateri);
    }

    /**
     * @test read
     */
    public function testReadMateri()
    {
        $materi = $this->makeMateri();
        $dbMateri = $this->materiRepo->find($materi->id);
        $dbMateri = $dbMateri->toArray();
        $this->assertModelData($materi->toArray(), $dbMateri);
    }

    /**
     * @test update
     */
    public function testUpdateMateri()
    {
        $materi = $this->makeMateri();
        $fakeMateri = $this->fakeMateriData();
        $updatedMateri = $this->materiRepo->update($fakeMateri, $materi->id);
        $this->assertModelData($fakeMateri, $updatedMateri->toArray());
        $dbMateri = $this->materiRepo->find($materi->id);
        $this->assertModelData($fakeMateri, $dbMateri->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMateri()
    {
        $materi = $this->makeMateri();
        $resp = $this->materiRepo->delete($materi->id);
        $this->assertTrue($resp);
        $this->assertNull(Materi::find($materi->id), 'Materi should not exist in DB');
    }
}
