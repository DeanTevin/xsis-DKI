<?php

namespace App\Containers\AppSection\Master\Data\Seeders;

use App\Containers\AppSection\Master\Models\MasterDistricts;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class MasterDistrictSeeder_3 extends ParentSeeder
{
    public function run(): void
    {
        $json = File::get(config("appSection-master.exportables.master_districts"));

        $districts = json_decode($json);

        foreach ($districts as $key => $value) {
            MasterDistricts::create([
                'id' => $value->id,
                'regency_id' => $value->regency_id,
                'district' => $value->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
