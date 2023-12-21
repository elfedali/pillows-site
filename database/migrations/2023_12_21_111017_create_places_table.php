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
        Schema::disableForeignKeyConstraints();

        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users');
            $table->string('name')->index('TBL_PLACES_NAME_INDEX');
            $table->string('slug')->unique();
            $table->string('slogan')->nullable();
            $table->text('description');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(true);
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->integer('max_guests')->nullable();
            $table->integer('num_bedrooms')->nullable();
            $table->integer('num_beds')->nullable();
            $table->integer('num_baths')->nullable();
            $table->integer('superficy')->nullable();
            $table->integer('check_in_hour')->nullable();
            $table->integer('check_out_hour')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->integer('min_stay')->nullable();
            $table->integer('max_stay')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
