<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Create customers (100 for testing)
        $customers = [];
        for ($i = 1; $i <= 100; $i++) {
            $customers[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Customer::insert($customers);
        
        // Create products (200 for testing)
        $products = [];
        for ($i = 1; $i <= 200; $i++) {
            $products[] = [
                'sku' => $faker->unique()->regexify('[A-Z]{3}[0-9]{4}'),
                'name' => $faker->words(3, true),
                'price' => $faker->randomFloat(2, 10, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Product::insert($products);
        
        // Get IDs for relationships
        $customerIds = Customer::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();
        
        // Create orders (300 for testing)
        for ($i = 1; $i <= 300; $i++) {
            $customerId = $faker->randomElement($customerIds);
            $orderDate = $faker->dateTimeBetween('-1 year', 'now');
            $status = $faker->randomElement(['pending', 'processing', 'completed', 'cancelled']);
            
            $order = Order::create([
                'customer_id' => $customerId,
                'order_date' => $orderDate,
                'status' => $status,
                'total_amount' => 0, // Will be calculated after adding items
            ]);
            
            // Create 1-5 order items for each order
            $itemCount = $faker->numberBetween(1, 5);
            $totalAmount = 0;
            
            for ($j = 1; $j <= $itemCount; $j++) {
                $productId = $faker->randomElement($productIds);
                $product = Product::find($productId);
                $quantity = $faker->numberBetween(1, 10);
                $price = $product->price;
                $itemTotal = $quantity * $price;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
                
                $totalAmount += $itemTotal;
            }
            
            // Update order with total amount
            $order->update(['total_amount' => $totalAmount]);
        }
    }
}