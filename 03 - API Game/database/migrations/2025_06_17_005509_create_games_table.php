<?php

use App\Constants\Table;
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
        Schema::create(Table::GAMES, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('thumb')->nullable();
            $table->string('video')->nullable();
            $table->date('release_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Table::GAMES);
    }
};
