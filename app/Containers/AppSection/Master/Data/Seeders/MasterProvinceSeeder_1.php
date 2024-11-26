<?php

namespace App\Containers\AppSection\Master\Data\Seeders;

use App\Containers\AppSection\Master\Models\MasterProvinces;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class MasterProvinceSeeder_1 extends ParentSeeder
{
    public function run(): void
    {
        $json = File::get(config("appSection-master.exportables.master_provinces"));

        $provinces = json_decode($json);

        foreach ($provinces as $key => $value) {
            MasterProvinces::create([
                'id' => $value->id,
                'province' => $value->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
