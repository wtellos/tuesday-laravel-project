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
        Schema::table('ninjas', function (Blueprint $table) {
            // Since vote counts cannot go below 0, we can use "unsignedInteger" for the counts
           $table->unsignedInteger('upvotes_count')->default(0);
           $table->unsignedInteger('downvotes_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ninjas', function (Blueprint $table) {
            // 
            $table->dropColumn(['upvotes_count', 'downvotes_count']);
        });
    }
};
