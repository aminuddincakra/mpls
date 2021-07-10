<?php

use Faker\Factory as Faker;
use App\Models\Pengumuman;
use App\Repositories\PengumumanRepository;

trait MakePengumumanTrait
{
    /**
     * Create fake instance of Pengumuman and save it in database
     *
     * @param array $pengumumanFields
     * @return Pengumuman
     */
    public function makePengumuman($pengumumanFields = [])
    {
        /** @var PengumumanRepository $pengumumanRepo */
        $pengumumanRepo = App::make(PengumumanRepository::class);
        $theme = $this->fakePengumumanData($pengumumanFields);
        return $pengumumanRepo->create($theme);
    }

    /**
     * Get fake instance of Pengumuman
     *
     * @param array $pengumumanFields
     * @return Pengumuman
     */
    public function fakePengumuman($pengumumanFields = [])
    {
        return new Pengumuman($this->fakePengumumanData($pengumumanFields));
    }

    /**
     * Get fake data of Pengumuman
     *
     * @param array $postFields
     * @return array
     */
    public function fakePengumumanData($pengumumanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'content' => $fake->text,
            'status' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $pengumumanFields);
    }
}
