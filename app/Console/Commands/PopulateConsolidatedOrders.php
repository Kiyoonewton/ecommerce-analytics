<?php

namespace App\Console\Commands;

use App\Models\ConsolidatedOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateConsolidatedOrders extends Command
{
    protected $signature = 'orders:consolidate {--chunk=1000 : Chunk size for processing}';
    protected $description = 'Populate the consolidated_orders table with data from normalized tables';

    public function handle()
    {
        $this->info('Starting consolidation process...');
        $startTime = now();
        $chunkSize = $this->option('chunk');
        
        // Truncate the consolidated_orders table to start fresh
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ConsolidatedOrder::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $this->info('Processing data in chunks of ' . $chunkSize);
        
        // Process data in chunks to avoid memory issues
        $processedCount = 0;
        
        DB::table('order_items')
            ->select([
                'order_items.id as id',
                'orders.id as order_id',
                'customers.id as customer_id',
                'customers.name as customer_name',
                'customers.email as customer_email',
                'products.id as product_id',
                'products.name as product_name',
                'products.sku as sku',
                'order_items.quantity as quantity',
                'order_items.price as item_price',
                DB::raw('order_items.quantity * order_items.price as line_total'),
                'orders.order_date as order_date',
                'orders.status as order_status',
                'orders.total_amount as order_total',
            ])
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->orderBy('order_items.id')
            ->chunk($chunkSize, function ($items) use (&$processedCount) {
                $dataToInsert = [];
                
                foreach ($items as $item) {
                    $dataToInsert[] = [
                        'order_id' => $item->order_id,
                        'customer_id' => $item->customer_id,
                        'customer_name' => $item->customer_name,
                        'customer_email' => $item->customer_email,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product_name,
                        'sku' => $item->sku,
                        'quantity' => $item->quantity,
                        'item_price' => $item->item_price,
                        'line_total' => $item->line_total,
                        'order_date' => $item->order_date,
                        'order_status' => $item->order_status,
                        'order_total' => $item->order_total,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                ConsolidatedOrder::insert($dataToInsert);
                $processedCount += count($dataToInsert);
                $this->info("Processed $processedCount records");
            });
        
        $endTime = now();
        $duration = $endTime->diffInSeconds($startTime);
        $this->info("Consolidation completed in $duration seconds");
        $this->info("Total records processed: $processedCount");
        
        return Command::SUCCESS;
    }
}