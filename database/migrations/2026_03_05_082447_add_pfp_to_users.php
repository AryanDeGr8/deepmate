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
        Schema::table('users', function (Blueprint $table) {
            //

            $table->string('pfp')->default('data:image/png;base64,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');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
