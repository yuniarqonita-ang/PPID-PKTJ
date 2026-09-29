<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDataSeeder extends Seeder
{
    public function run()
    {
        $sqlPath = base_path('database/user_updates_2026_09_29.sql');
        if (file_exists($sqlPath)) {
            $sql = file_get_contents($sqlPath);
            $statements = array_filter(array_map('trim', explode(";\n\n", $sql)));
            foreach ($statements as $stmt) {
                if (!empty($stmt) && !str_starts_with($stmt, '--')) {
                    DB::unprepared($stmt);
                }
            }
        }
    }
}
