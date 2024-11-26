<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        

        if(config('database.default') == 'pgsql'){
            Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('log_name')->nullable();
                $table->text('description');
                $table->nullableUuidMorphs('subject', 'subject');
                $table->nullableUuidMorphs('causer', 'causer');
                $table->json('properties')->nullable();
                $table->foreignId('log_level')->nullable()->constrained(table: 'log_level', indexName: 'id')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
                $table->index('log_name');
            });
        }else{
            Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('log_name')->nullable();
                $table->text('description');
                $table->nullableUuidMorphs('subject', 'subject');
                $table->nullableUuidMorphs('causer', 'causer');
                $table->json('properties')->nullable();
                $table->integer('log_level');
                $table->timestamps();
                $table->index('log_name');

                $table->foreign('log_level')->references('id')->on('log_level')->onUpdate('cascade')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}
