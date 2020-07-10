<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MateriApiTest extends TestCase
{
    use MakeMateriTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMateri()
    {
        $materi = $this->fakeMateriData();
        $this->json('POST', '/api/v1/materis', $materi);

        $this->assertApiResponse($materi);
    }

    /**
     * @test
     */
    public function testReadMateri()
    {
        $materi = $this->makeMateri();
        $this->json('GET', '/api/v1/materis/'.$materi->id);

        $this->assertApiResponse($materi->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMateri()
    {
        $materi = $this->makeMateri();
        $editedMateri = $this->fakeMateriData();

        $this->json('PUT', '/api/v1/materis/'.$materi->id, $editedMateri);

        $this->assertApiResponse($editedMateri);
    }

    /**
     * @test
     */
    public function testDeleteMateri()
    {
        $materi = $this->makeMateri();
        $this->json('DELETE', '/api/v1/materis/'.$materi->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/materis/'.$materi->id);

        $this->assertResponseStatus(404);
    }
}
