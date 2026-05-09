<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    DB::statement('ALTER TABLE messages DROP FOREIGN KEY messages_from_id_foreign');
    DB::statement('ALTER TABLE messages MODIFY from_id VARCHAR(255) NULL');
}

public function down(): void
{
    DB::statement('ALTER TABLE messages MODIFY from_id BIGINT UNSIGNED NULL');
}
};
