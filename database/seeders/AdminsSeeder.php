<?php

namespace Database\Seeders;

use App\Models\Admins;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Admins::create([
            'username' => 'Super Admin',
            'name' => 'super admin',
            'password' => bcrypt('123456'),
            'level' => '0',
            'role' => 'super admin'
        ]);
    }
}
