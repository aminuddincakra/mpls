<?php

use Faker\Factory as Faker;
use App\Models\Kelas;
use App\Repositories\KelasRepository;

trait MakeKelasTrait
{
    /**
     * Create fake instance of Kelas and save it in database
     *
     * @param array $kelasFields
     * @return Kelas
     */
    public function makeKelas($kelasFields = [])
    {
        /** @var KelasRepository $kelasRepo */
        $kelasRepo = App::make(KelasRepository::class);
        $theme = $this->fakeKelasData($kelasFields);
        return $kelasRepo->create($theme);
    }

    /**
     * Get fake instance of Kelas
     *
     * @param array $kelasFields
     * @return Kelas
     */
    public function fakeKelas($kelasFields = [])
    {
        return new Kelas($this->fakeKelasData($kelasFields));
    }

    /**
     * Get fake data of Kelas
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKelasData($kelasFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $kelasFields);
    }
}
