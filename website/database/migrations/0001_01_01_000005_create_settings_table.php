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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->boolean('showOpen')->default(true); 
            $table->boolean('showCountdown')->default(false);
            $table->boolean('showMadeBy')->default(false);
            $table->string('background')->default('#f9f9f9');
            $table->string('titleColor')->default('#000000');
            $table->string('textColor')->default('#515151');
            $table->string('buttonColor')->default('#ff4d00');
            $table->string('buttonText')->default('#f9f9f9');
            $table->string('buttonclColor')->default('#515151');
            $table->string('buttonclText')->default('#f9f9f9');
            $table->string('deleteColor')->default('#FF0000');
            $table->timestamps();
        }); 
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
