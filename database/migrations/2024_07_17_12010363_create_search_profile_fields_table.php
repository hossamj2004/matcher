<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create("search_profile_fields", function (Blueprint $table) {
            $table->id();
            $table->foreignId('search_profile_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('field_name', 255);
            $table->decimal('min_range_value', 15,2)->nullable();
            $table->decimal('max_range_value', 15,2)->nullable();
            $table->string('exact_value', 255)->nullable();
            $table->string('field_type', 255);
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_profile_fields');
    }
};
