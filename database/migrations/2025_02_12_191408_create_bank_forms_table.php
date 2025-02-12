<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * This method creates the 'bank_forms' table with the required fields.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_forms', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('bank_name'); // Name of the bank
            $table->string('form_name'); // Name/Title of the form
            $table->string('form_file'); // File path or filename for the form (could be a PDF, DOC, etc.)
            // You can add additional fields here as needed, for example:
            // $table->text('description')->nullable();
            $table->timestamps(); // Automatically creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method drops the 'bank_forms' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_forms');
    }
};
