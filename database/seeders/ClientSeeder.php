<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\client;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();

        for ($i=1; $i<11; $i++){
        $client=new client();
        $client->name=$faker->name;
        $client->email=$faker->email;
        $client->contact=$faker->phoneNumber;
        $client->gender="M";
        $client->caste="obc";
        $client->course_id=1;
        $client->save();
        }

    }
}
