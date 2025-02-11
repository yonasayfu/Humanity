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
        Schema::create('supporters', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Supporter's full name
            $table->enum('type', ['government', 'NGO', 'private', 'individual']); // Supporter classification
            $table->string('phone_number', 20)->nullable(); // Optional phone number
            $table->string('email')->nullable(); // Optional email
            $table->text('address')->nullable(); // Address details
            $table->decimal('contribution_amount', 10, 2)->default(0); // Total contributed amount
            $table->string('photo_url')->nullable(); // Photo URL if the supporter wants to display it
            $table->text('testimonial_content')->nullable(); // Optional testimonial
            $table->timestamps(); // Created at & Updated at timestamps
            $table->softDeletes(); // Add soft delete column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supporters');
    }
};
