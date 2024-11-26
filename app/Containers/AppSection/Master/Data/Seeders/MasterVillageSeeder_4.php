<?php

namespace App\Containers\AppSection\Master\Data\Seeders;

use App\Containers\AppSection\Master\Models\MasterVillages;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MasterVillageSeeder_4 extends ParentSeeder
{
    public function run(): void
    {
        $json = File::get(config("appSection-master.exportables.master_villages"));

        $villages = collect(json_decode($json,true));
        $chunks = $villages->chunk(700); 

        foreach ($chunks as $villageChunk){
            MasterVillages::insert($villageChunk->toArray());
        }
    }
}
