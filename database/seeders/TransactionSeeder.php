<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Table cleaning
        Transaction::query()->delete();

        Transaction::create([
            'user_id' => '3',
            'amount' => 100.00,
            'type' => 'credit',
            'status' => 'completed',
            'description' => 'Payment for service',
        ]);

        $this->command->info(class_basename(__CLASS__) . ' completed');
    }
}
