<?php

namespace Database\Seeders;

use App\Models\purchase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        purchase::factory()->count(30)->create();
    }
}
