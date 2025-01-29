<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('gambar')->nullable();
            $table->string('name');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('domain')->unique();
            $table->string('database')->unique();
            $table->timestamps();
        });
    }
};
