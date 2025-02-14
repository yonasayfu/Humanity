<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the 'donation_agreements' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_agreements', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign key linking to the supporters table
            $table->unsignedBigInteger('supporter_id');
            $table->foreign('supporter_id')->references('id')->on('supporters')->onDelete('cascade');

            // Foreign key linking to the bank_forms table
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('bank_forms')->onDelete('cascade');

            // Donation details
            $table->string('donation_type'); // e.g., "one-time", "recurring"
            $table->decimal('donation_amount', 10, 2);
            $table->string('recurring_interval')->nullable(); // e.g., "monthly", "yearly" (nullable for one-time donations)

            // File upload field for the signed agreement PDF
            $table->string('signed_agreement_pdf');

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method drops the 'donation_agreements' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_agreements');
    }
};
