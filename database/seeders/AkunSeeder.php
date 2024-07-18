<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat User Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@sekawan.com',
            'password' => bcrypt('sekawan') // Ganti 'password' dengan password yang diinginkan
        ]);

        // Assign Role Admin
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Buat User Approver
        $approver = User::create([
            'name' => 'Approver',
            'email' => 'approver@sekawan.com',
            'password' => bcrypt('sekawan') // Ganti 'password' dengan password yang diinginkan
        ]);

        // Assign Role Approver
        $approverRole = Role::where('name', 'approver')->first();
        if ($approverRole) {
            $approver->assignRole($approverRole);
        }

        // Buat User Karyawan
        $karyawan = User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@sekawan.com',
            'password' => bcrypt('sekawan') // Ganti 'password' dengan password yang diinginkan
        ]);

        // Assign Role Karyawan
        $karyawanRole = Role::where('name', 'karyawan')->first();
        if ($karyawanRole) {
            $karyawan->assignRole($karyawanRole);
        }
    }
}
