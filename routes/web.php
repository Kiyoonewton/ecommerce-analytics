<?php

use App\Http\Controllers\ConsolidatedOrderController;
use App\Http\Controllers\GraphQLController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('consolidated-orders.index');
});

// Consolidated Orders Web Routes
Route::get('/consolidated-orders', [ConsolidatedOrderController::class, 'index'])
    ->name('consolidated-orders.index');

Route::get('/consolidated-orders/export', [ConsolidatedOrderController::class, 'export'])
    ->name('consolidated-orders.export');

Route::get('/consolidated-orders/import', [ConsolidatedOrderController::class, 'importForm'])
    ->name('consolidated-orders.import.form');

Route::post('/consolidated-orders/import', [ConsolidatedOrderController::class, 'import'])
    ->name('consolidated-orders.import');

// GraphQL Playground
Route::get('/graphql-playground', [GraphQLController::class, 'playground'])
    ->name('graphql.playground');