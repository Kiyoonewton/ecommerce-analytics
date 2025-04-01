<?php

namespace App\GraphQL\Queries;

use App\Models\ConsolidatedOrder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ConsolidatedOrdersQuery
{
    /**
     * @param null $rootValue
     * @param array $args
     * @return Builder
     */
    public function __invoke($rootValue, array $args): Builder
    {
        $query = ConsolidatedOrder::query();
        
        // Apply filters if provided
        if (isset($args['dateFrom'])) {
            $query->where('order_date', '>=', $args['dateFrom']);
        }
        
        if (isset($args['dateTo'])) {
            $query->where('order_date', '<=', $args['dateTo']);
        }
        
        if (isset($args['customerEmail'])) {
            $query->where('customer_email', 'like', '%' . $args['customerEmail'] . '%');
        }
        
        if (isset($args['sku'])) {
            $query->where('sku', 'like', '%' . $args['sku'] . '%');
        }
        
        if (isset($args['orderStatus'])) {
            $query->where('order_status', $args['orderStatus']);
        }
        
        return $query;
    }
}