<?php

namespace App\Imports;

use App\Models\ConsolidatedOrder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class ConsolidatedOrdersImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    public function model(array $row)
    {
        return ConsolidatedOrder::updateOrCreate(
            ['id' => $row['id']],
            [
                'order_id' => $row['order_id'],
                'customer_id' => $row['customer_id'],
                'customer_name' => $row['customer_name'],
                'customer_email' => $row['customer_email'],
                'product_id' => $row['product_id'],
                'product_name' => $row['product_name'],
                'sku' => $row['sku'],
                'quantity' => $row['quantity'],
                'item_price' => $row['item_price'],
                'line_total' => $row['line_total'],
                'order_date' => $row['order_date'],
                'order_status' => $row['order_status'],
                'order_total' => $row['order_total'],
            ]
        );
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
    
    public function rules(): array
    {
        return [
            '*.id' => 'required|integer',
            '*.order_id' => 'required|integer',
            '*.customer_id' => 'required|integer',
            '*.product_id' => 'required|integer',
            '*.quantity' => 'required|integer',
            '*.item_price' => 'required|numeric',
            '*.line_total' => 'required|numeric',
            '*.order_total' => 'required|numeric',
        ];
    }
}