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
        Schema::table('supporters', function (Blueprint $table) {
            $table->softDeletes(); // Add soft delete column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporters', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Remove soft delete column if rolling back
        });
    }
};
