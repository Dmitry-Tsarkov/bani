<?php


namespace app\modules\seeder\helpers;

use Faker\Factory;

class DateHelper
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('ru_RU');
    }

    public function addTime($instance)
    {
        $updatedAt = $this->faker->unixTime('now');
        $instance->updateAttributes([
            'created_at' => $this->faker->unixTime($updatedAt),
            'updated_at' => $updatedAt,
        ]);
    }
}