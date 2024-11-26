<?php

namespace App\Containers\AppSection\Master\Data\Seeders;

use App\Containers\AppSection\Master\Models\MasterProvinces;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MasterOccupationSeeder_1 extends ParentSeeder
{
    public function run(): void
    {
        $json = File::get(config("appSection-master.exportables.master_occupations"));

        $occupations = json_decode($json,true);
        DB::table('master_occupations')->insert($occupations);
    }
}
