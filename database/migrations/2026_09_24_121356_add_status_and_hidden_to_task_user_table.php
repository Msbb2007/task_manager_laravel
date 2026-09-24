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
        Schema::table('task_user', function (Blueprint $table) {
            $table->string('state_of_this_task_user')->default('in_progress')->after('user_id');

            $table->boolean('is_hidden')->default(false)->after('state_of_this_task_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_user', function (Blueprint $table) {
            $table->dropColumn(['state_of_this_task_user', 'is_hidden']);
        });
    }
};
