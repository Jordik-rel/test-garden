<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'nom' => 'Admin ',
            'prenom' => 'Green',
            'username' => 'admin-green',
            'email' => 'admin@green.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '1234567890',
            'email_verified_at'=>now()
        ]);

        DB::table('users')->insert([
            'nom' => 'DOE ',
            'prenom' => 'John',
            'username' => 'jdoe',
            'email' => 'joe@doe.com',
            'password' => bcrypt('password'),
            'role' => 'jardinier',
            'phone' => '0123456789',
            'email_verified_at'=>now()
        ]);

        DB::table('users')->insert([
            'nom' => 'DANSOU ',
            'prenom' => 'Junior',
            'username' => 'jdansou',
            'email' => 'dansou@junior.com',
            'password' => bcrypt('password'),
            'role' => 'jardinier',
            'phone' => '0128456789',
            'email_verified_at'=>now()
        ]);

        DB::table('users')->insert([
            'nom' => 'ZINSOU ',
            'prenom' => 'Math',
            'username' => 'zmath',
            'email' => 'math@zinsou.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'phone' => '0123458789',
            'email_verified_at'=>now()
        ]);

        $this->call(CompetenceSeeder::class);
        $this->call(JardinierSeeder::class);
    }
}
