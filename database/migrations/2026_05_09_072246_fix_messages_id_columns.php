<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Run: php artisan make:migration fix_messages_id_columns
// Then replace the content with this file.

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // FIX: from_id stores guest_xxx strings so must be VARCHAR not INT
            $table->string('from_id', 64)->change();
            $table->string('to_id',   64)->change();
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('from_id')->change();
            $table->unsignedBigInteger('to_id')->change();
        });
    }
};