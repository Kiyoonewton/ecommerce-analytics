<?php

namespace App\Http\Controllers;

use App\Exports\ConsolidatedOrdersExport;
use App\Imports\ConsolidatedOrdersImport;
use App\Models\ConsolidatedOrder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ConsolidatedOrderController extends Controller
{
    public function index()
    {
        $totalRecords = ConsolidatedOrder::count();
        $orders = ConsolidatedOrder::paginate(25);
        
        return view('consolidated-orders.index', compact('orders', 'totalRecords'));
    }
    
    public function export()
    {
        return Excel::download(new ConsolidatedOrdersExport, 'consolidated_orders_' . now()->format('Y-m-d') . '.xlsx');
    }
    
    public function importForm()
    {
        return view('consolidated-orders.import');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        
        Excel::import(new ConsolidatedOrdersImport, $request->file('file'));
        
        return redirect()->route('consolidated-orders.index')
            ->with('success', 'Data imported successfully!');
    }
}