<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SesiApiTest extends TestCase
{
    use MakeSesiTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSesi()
    {
        $sesi = $this->fakeSesiData();
        $this->json('POST', '/api/v1/sesis', $sesi);

        $this->assertApiResponse($sesi);
    }

    /**
     * @test
     */
    public function testReadSesi()
    {
        $sesi = $this->makeSesi();
        $this->json('GET', '/api/v1/sesis/'.$sesi->id);

        $this->assertApiResponse($sesi->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSesi()
    {
        $sesi = $this->makeSesi();
        $editedSesi = $this->fakeSesiData();

        $this->json('PUT', '/api/v1/sesis/'.$sesi->id, $editedSesi);

        $this->assertApiResponse($editedSesi);
    }

    /**
     * @test
     */
    public function testDeleteSesi()
    {
        $sesi = $this->makeSesi();
        $this->json('DELETE', '/api/v1/sesis/'.$sesi->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sesis/'.$sesi->id);

        $this->assertResponseStatus(404);
    }
}
