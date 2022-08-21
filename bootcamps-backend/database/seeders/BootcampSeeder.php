<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bootcamp;
use File;

class BootcampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Bootcamp::truncate();
         
        $json = File::get("database/_data/bootcamps.json");
        $bootcamps = json_decode($json);
  
        foreach ($bootcamps as $key => $value) {
            Bootcamp::create([
                "name" => $value->name,
                "website" => $value->website,
                "email" => $value->email,
                "address" => $value->address,
                "phone" => $value->phone,
                "user_id" => $value->user_id
            ]);
        }
    }
}
