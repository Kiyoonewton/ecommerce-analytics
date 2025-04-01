<?php

namespace App\GraphQL\Queries;

use App\Models\ConsolidatedOrder;
use Illuminate\Support\Facades\DB;

class OrderAnalytics
{
    /**
     * Calculate order analytics.
     *
     * @param  null  $rootValue
     * @param  array  $args
     * @return array
     */
    public function __invoke($rootValue, array $args)
    {
        $query = ConsolidatedOrder::query();
        
        if (isset($args['dateFrom'])) {
            $query->where('order_date', '>=', $args['dateFrom']);
        }
        
        if (isset($args['dateTo'])) {
            $query->where('order_date', '<=', $args['dateTo']);
        }
        
        $distinctOrderIds = $query->clone()->distinct('order_id')->pluck('order_id');
        $totalOrders = $distinctOrderIds->count();
        
        $totalRevenue = $query->clone()->sum('line_total');
        
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        
        $topProducts = $query->clone()
            ->select(
                'product_id',
                'product_name',
                'sku',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(line_total) as total_revenue')
            )
            ->groupBy('product_id', 'product_name', 'sku')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get()
            ->toArray();
        
        $topCustomers = $query->clone()
            ->select(
                'customer_id',
                'customer_name',
                'customer_email',
                DB::raw('COUNT(DISTINCT order_id) as order_count'),
                DB::raw('SUM(line_total) as total_spend')
            )
            ->groupBy('customer_id', 'customer_name', 'customer_email')
            ->orderByDesc('total_spend')
            ->limit(5)
            ->get()
            ->toArray();
        
        $salesByStatus = $query->clone()
            ->select(
                'order_status as status',
                DB::raw('COUNT(DISTINCT order_id) as order_count'),
                DB::raw('SUM(line_total) as total_revenue')
            )
            ->groupBy('order_status')
            ->orderByDesc('total_revenue')
            ->get()
            ->toArray();
        
        return [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'averageOrderValue' => $averageOrderValue,
            'topProducts' => $topProducts,
            'topCustomers' => $topCustomers,
            'salesByStatus' => $salesByStatus,
        ];
    }
}
