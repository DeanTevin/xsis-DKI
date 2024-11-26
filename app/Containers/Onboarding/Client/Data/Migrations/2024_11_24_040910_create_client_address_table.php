<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('client_address', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('client_id')->references('uuid')->on('clients');
            $table->unsignedBigInteger('village_id');
            $table->foreign('village_id')->references('id')->on('master_villages');
            $table->string('address',255);
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_address');
    }
};
