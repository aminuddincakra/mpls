<?php

use Faker\Factory as Faker;
use App\Models\Jurusan;
use App\Repositories\JurusanRepository;

trait MakeJurusanTrait
{
    /**
     * Create fake instance of Jurusan and save it in database
     *
     * @param array $jurusanFields
     * @return Jurusan
     */
    public function makeJurusan($jurusanFields = [])
    {
        /** @var JurusanRepository $jurusanRepo */
        $jurusanRepo = App::make(JurusanRepository::class);
        $theme = $this->fakeJurusanData($jurusanFields);
        return $jurusanRepo->create($theme);
    }

    /**
     * Get fake instance of Jurusan
     *
     * @param array $jurusanFields
     * @return Jurusan
     */
    public function fakeJurusan($jurusanFields = [])
    {
        return new Jurusan($this->fakeJurusanData($jurusanFields));
    }

    /**
     * Get fake data of Jurusan
     *
     * @param array $postFields
     * @return array
     */
    public function fakeJurusanData($jurusanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $jurusanFields);
    }
}
