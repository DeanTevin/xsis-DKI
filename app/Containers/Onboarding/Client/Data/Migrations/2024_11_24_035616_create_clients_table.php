<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name');
            $table->string('birthPlace');
            $table->date('birthDate');
            $table->enum('gender', ['M','F']);
            $table->unsignedBigInteger('occupation_id');
            $table->foreign('occupation_id')->references('id')->on('master_occupations');
            $table->integer('annualDeposit');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
