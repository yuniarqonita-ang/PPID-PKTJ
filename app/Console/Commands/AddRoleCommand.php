<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddRoleCommand extends Command
{
    protected $signature = 'db:add-role';
    protected $description = 'Adds role column to users table';

    public function handle()
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'operator'])->default('operator')->after('password');
            });
            $this->info('Role field added successfully!');
        } else {
            $this->info('Role field already exists.');
        }
    }
}
