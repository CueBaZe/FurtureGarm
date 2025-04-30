<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->integer('capsule_id');
            $table->string('name');
            $table->string('path');
            $table->string('extension');
        }); 

    }

    public function down(): void
    {
        Schema::dropIfExists('medias');

    }
};