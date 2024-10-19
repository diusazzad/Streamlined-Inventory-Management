<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // $seeders=[
        //     'CustomerSeeder',
        //     'SupplierSeeder',
        //     'CategorySeeder',
        //     'UnitSeeder',
        //     'ProductSeeder',
        //     'OrderSeeder',
        //     'OrderDetailSeeder',
        //     'PurchaseSeeder',
        //     'PurchaseDetailSeeder',
        //     'QuotationSeeder',
        //     'QuotationDetailSeeder',
        //     'NotificationSeeder',


        // ];
        // $this->call($seeders);
        $this->call([
            CustomerSeeder::class,
            // SupplierSeeder::class,
            // CategorySeeder::class,
            // UnitSeeder::class,
            // ProductSeeder::class,
            // OrderSeeder::class,
            // OrderDetailSeeder::class,
            // PurchaseSeeder::class,
            // PurchaseDetailSeeder::class,
            // QuotationSeeder::class,
            // QuotationDetailSeeder::class,
            // NotificationSeeder::class
        ]);
    }
}
