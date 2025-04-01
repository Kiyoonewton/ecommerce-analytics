<?php

namespace App\Exports;

use App\Models\ConsolidatedOrder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ConsolidatedOrdersExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    public function query()
    {
        return ConsolidatedOrder::query();
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Order ID',
            'Customer ID',
            'Customer Name',
            'Customer Email',
            'Product ID',
            'Product Name',
            'SKU',
            'Quantity',
            'Item Price',
            'Line Total',
            'Order Date',
            'Order Status',
            'Order Total',
        ];
    }
    
    public function map($consolidatedOrder): array
    {
        return [
            $consolidatedOrder->id,
            $consolidatedOrder->order_id,
            $consolidatedOrder->customer_id,
            $consolidatedOrder->customer_name,
            $consolidatedOrder->customer_email,
            $consolidatedOrder->product_id,
            $consolidatedOrder->product_name,
            $consolidatedOrder->sku,
            $consolidatedOrder->quantity,
            $consolidatedOrder->item_price,
            $consolidatedOrder->line_total,
            $consolidatedOrder->order_date->format('Y-m-d H:i:s'),
            $consolidatedOrder->order_status,
            $consolidatedOrder->order_total,
        ];
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}