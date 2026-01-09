<?php
// File: database/seeders/AdminUserSeeder.php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@kotaksaran.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        echo "Admin user created: admin@kotaksaran.com (password: password)\n";
    }
}

?>