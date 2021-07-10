<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PengumumanApiTest extends TestCase
{
    use MakePengumumanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePengumuman()
    {
        $pengumuman = $this->fakePengumumanData();
        $this->json('POST', '/api/v1/pengumumen', $pengumuman);

        $this->assertApiResponse($pengumuman);
    }

    /**
     * @test
     */
    public function testReadPengumuman()
    {
        $pengumuman = $this->makePengumuman();
        $this->json('GET', '/api/v1/pengumumen/'.$pengumuman->id);

        $this->assertApiResponse($pengumuman->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePengumuman()
    {
        $pengumuman = $this->makePengumuman();
        $editedPengumuman = $this->fakePengumumanData();

        $this->json('PUT', '/api/v1/pengumumen/'.$pengumuman->id, $editedPengumuman);

        $this->assertApiResponse($editedPengumuman);
    }

    /**
     * @test
     */
    public function testDeletePengumuman()
    {
        $pengumuman = $this->makePengumuman();
        $this->json('DELETE', '/api/v1/pengumumen/'.$pengumuman->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pengumumen/'.$pengumuman->id);

        $this->assertResponseStatus(404);
    }
}
