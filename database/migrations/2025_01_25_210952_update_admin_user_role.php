<?php

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update the first user (admin) to have admin role
        DB::table('users')
            ->where('id', 1)
            ->update(['role' => UserRole::ADMIN->value]);
    }

    public function down(): void
    {
        // Revert the first user back to agent role
        DB::table('users')
            ->where('id', 1)
            ->update(['role' => UserRole::AGENT->value]);
    }
}; 