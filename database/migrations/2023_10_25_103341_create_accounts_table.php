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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_image')->nullable();
            $table->text('skills');
            $table->text('about');
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('phone')->nullable();
            $table->integer('views')->default(0);
            //jei istrinsim vartotoja, istrinsim ir profili.
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
