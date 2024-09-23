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
        Schema::create('tblsignup', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('address');
            $table->integer('phonenumber');
            $table->string('gender');
            $table->binary('uploadimage')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tblsignup');
    }
};
