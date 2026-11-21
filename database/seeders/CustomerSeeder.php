<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'full_name' => 'Juan Dela Cruz',
                'email' => 'juan@example.com',
                'phone' => '0917-123-4567',
            ],
            [
                'full_name' => 'Maria Santos',
                'email' => 'maria@example.com',
                'phone' => '0918-234-5678',
            ],
            [
                'full_name' => 'Carlo Reyes',
                'email' => 'carlo@example.com',
                'phone' => '0919-345-6789',
            ],
            [
                'full_name' => 'Angela Garcia',
                'email' => 'angela@example.com',
                'phone' => '0920-456-7890',
            ],
            [
                'full_name' => 'Miguel Mendoza',
                'email' => 'miguel@example.com',
                'phone' => '0921-567-8901',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['email' => $customer['email']],
                [
                    'full_name' => $customer['full_name'],
                    'phone' => $customer['phone'],
                ]
            );
        }
    }
}
