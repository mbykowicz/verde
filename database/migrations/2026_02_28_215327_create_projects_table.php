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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained()->restrictOnDelete()->index();
            $table->foreignId('client_id')->constrained()->restrictOnDelete()->index();
            $table->string('unique_number')->unique();
            $table->string('contract_number')->unique();
            $table->string('name')->index();
            $table->text('notes')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();

            $table->enum('scope', ProjectType::cases())->default(ProjectType::New);
            $table->enum('sector', ProjectSector::cases())->default(ProjectSector::Residential);
            $table->enum('status', ProjectStatus::cases())->default(ProjectStatus::Draft)->index();

            $table->date('installation_scheduled_at')->nullable();
            $table->date('installation_completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['latitude', 'longitude']);
            $table->index(['city', 'postal_code']);
            $table->index(['status', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
