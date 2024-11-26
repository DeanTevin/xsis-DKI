<?php

namespace App\Containers\AppSection\Master\Data\Seeders;

use App\Containers\AppSection\Master\Models\MasterRegencies;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class MasterRegencySeeder_2 extends ParentSeeder
{
    public function run(): void
    {
        $json = File::get(config("appSection-master.exportables.master_regencies"));

        $regencies = json_decode($json);

        foreach ($regencies as $key => $value) {
            MasterRegencies::create([
                'id' => $value->id,
                'province_id' => $value->province_id,
                'regency' => $value->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
