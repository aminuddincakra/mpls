<?php

use Faker\Factory as Faker;
use App\Models\Sesi;
use App\Repositories\SesiRepository;

trait MakeSesiTrait
{
    /**
     * Create fake instance of Sesi and save it in database
     *
     * @param array $sesiFields
     * @return Sesi
     */
    public function makeSesi($sesiFields = [])
    {
        /** @var SesiRepository $sesiRepo */
        $sesiRepo = App::make(SesiRepository::class);
        $theme = $this->fakeSesiData($sesiFields);
        return $sesiRepo->create($theme);
    }

    /**
     * Get fake instance of Sesi
     *
     * @param array $sesiFields
     * @return Sesi
     */
    public function fakeSesi($sesiFields = [])
    {
        return new Sesi($this->fakeSesiData($sesiFields));
    }

    /**
     * Get fake data of Sesi
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSesiData($sesiFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'jumlah' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $sesiFields);
    }
}
