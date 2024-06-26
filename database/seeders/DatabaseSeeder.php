<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Collection;
use Illuminate\Database\Seeder;
use App\Models\CollectionProduct;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sam John',
            'email' => 'samjohn@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);
        Product::factory(100)->create();
        Collection::factory(100)->create();

        $i = 1;
        while ($i <= 500) {
            try {
                CollectionProduct::factory()->create();
                $i++;
            } catch (\Illuminate\Database\QueryException $e) {
                continue;
            }
        }
    }
}
