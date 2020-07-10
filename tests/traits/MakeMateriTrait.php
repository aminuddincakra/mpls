<?php

use Faker\Factory as Faker;
use App\Models\Materi;
use App\Repositories\MateriRepository;

trait MakeMateriTrait
{
    /**
     * Create fake instance of Materi and save it in database
     *
     * @param array $materiFields
     * @return Materi
     */
    public function makeMateri($materiFields = [])
    {
        /** @var MateriRepository $materiRepo */
        $materiRepo = App::make(MateriRepository::class);
        $theme = $this->fakeMateriData($materiFields);
        return $materiRepo->create($theme);
    }

    /**
     * Get fake instance of Materi
     *
     * @param array $materiFields
     * @return Materi
     */
    public function fakeMateri($materiFields = [])
    {
        return new Materi($this->fakeMateriData($materiFields));
    }

    /**
     * Get fake data of Materi
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMateriData($materiFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'file' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $materiFields);
    }
}
