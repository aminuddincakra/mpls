<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KelasApiTest extends TestCase
{
    use MakeKelasTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKelas()
    {
        $kelas = $this->fakeKelasData();
        $this->json('POST', '/api/v1/kelas', $kelas);

        $this->assertApiResponse($kelas);
    }

    /**
     * @test
     */
    public function testReadKelas()
    {
        $kelas = $this->makeKelas();
        $this->json('GET', '/api/v1/kelas/'.$kelas->id);

        $this->assertApiResponse($kelas->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKelas()
    {
        $kelas = $this->makeKelas();
        $editedKelas = $this->fakeKelasData();

        $this->json('PUT', '/api/v1/kelas/'.$kelas->id, $editedKelas);

        $this->assertApiResponse($editedKelas);
    }

    /**
     * @test
     */
    public function testDeleteKelas()
    {
        $kelas = $this->makeKelas();
        $this->json('DELETE', '/api/v1/kelas/'.$kelas->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/kelas/'.$kelas->id);

        $this->assertResponseStatus(404);
    }
}
