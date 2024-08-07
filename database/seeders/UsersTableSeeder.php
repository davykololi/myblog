<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user1 = User::create([
            'name' => 'Kololi M David',
            'email' => 'kololimdavid@gmail.com',
            'assigned_role' => 'admin',
            'password' => Hash::make('kenyayangu17'),
            'slug' => Str::slug('Kololi M David'),
            'remember_token' => null,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        $user1->assignRole($user1->assigned_role);

        $user2 = User::create([
            'name' => 'Whitney Loice',
            'email' => 'whitney@gmail.com',
            'assigned_role' => 'author',
            'password' => Hash::make('Whitney0000**'),
            'slug' => Str::slug('Whitney Loice'),
            'remember_token' => null,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        $user2->assignRole($user2->assigned_role);

        $user3 = User::create([
            'name' => 'Mary Nafula',
            'email' => 'mary@gmail.com',
            'assigned_role' => 'editor',
            'password' => Hash::make('Mary0000**'),
            'slug' => Str::slug('Mary Nafula'),
            'remember_token' => null,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        $user3->assignRole($user3->assigned_role);

        $user4 = User::create([
            'name' => 'John Karanja',
            'email' => 'john@gmail.com',
            'assigned_role' => 'visitor',
            'password' => Hash::make('John0000**'),
            'slug' => Str::slug('John Karanja'),
            'remember_token' => null,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $user4->assignRole($user4->assigned_role);
    }
}
