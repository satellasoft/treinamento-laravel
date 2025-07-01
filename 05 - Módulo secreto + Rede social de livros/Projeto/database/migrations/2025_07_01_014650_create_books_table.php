<?php

use App\Constants\Tables;
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
        Schema::create(Tables::BOOKS, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('cover')->nullable();
            $table->text('description')->nullable();

            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('user_id')->constrained('users');

            $table->boolean('complete')->default(false);
            $table->boolean('favorite')->default(false);
            $table->tinyInteger('stars')->unsigned()->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::BOOKS);
    }
};
