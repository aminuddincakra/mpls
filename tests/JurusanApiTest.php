<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JurusanApiTest extends TestCase
{
    use MakeJurusanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateJurusan()
    {
        $jurusan = $this->fakeJurusanData();
        $this->json('POST', '/api/v1/jurusans', $jurusan);

        $this->assertApiResponse($jurusan);
    }

    /**
     * @test
     */
    public function testReadJurusan()
    {
        $jurusan = $this->makeJurusan();
        $this->json('GET', '/api/v1/jurusans/'.$jurusan->id);

        $this->assertApiResponse($jurusan->toArray());
    }

    /**
     * @test
     */
    public function testUpdateJurusan()
    {
        $jurusan = $this->makeJurusan();
        $editedJurusan = $this->fakeJurusanData();

        $this->json('PUT', '/api/v1/jurusans/'.$jurusan->id, $editedJurusan);

        $this->assertApiResponse($editedJurusan);
    }

    /**
     * @test
     */
    public function testDeleteJurusan()
    {
        $jurusan = $this->makeJurusan();
        $this->json('DELETE', '/api/v1/jurusans/'.$jurusan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/jurusans/'.$jurusan->id);

        $this->assertResponseStatus(404);
    }
}
