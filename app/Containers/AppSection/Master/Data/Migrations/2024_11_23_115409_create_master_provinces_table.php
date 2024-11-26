<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('master_provinces', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('province');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_provinces');
    }
};
