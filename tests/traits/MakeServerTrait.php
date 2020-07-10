<?php

use Faker\Factory as Faker;
use App\Models\Server;
use App\Repositories\ServerRepository;

trait MakeServerTrait
{
    /**
     * Create fake instance of Server and save it in database
     *
     * @param array $serverFields
     * @return Server
     */
    public function makeServer($serverFields = [])
    {
        /** @var ServerRepository $serverRepo */
        $serverRepo = App::make(ServerRepository::class);
        $theme = $this->fakeServerData($serverFields);
        return $serverRepo->create($theme);
    }

    /**
     * Get fake instance of Server
     *
     * @param array $serverFields
     * @return Server
     */
    public function fakeServer($serverFields = [])
    {
        return new Server($this->fakeServerData($serverFields));
    }

    /**
     * Get fake data of Server
     *
     * @param array $postFields
     * @return array
     */
    public function fakeServerData($serverFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'jumlah' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $serverFields);
    }
}
