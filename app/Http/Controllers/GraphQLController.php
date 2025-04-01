<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GraphQLController extends Controller
{
    /**
     * Show GraphQL Playground UI
     *
     * @return \Illuminate\View\View
     */
    public function playground()
    {
        return View::make('graphql.playground');
    }
}