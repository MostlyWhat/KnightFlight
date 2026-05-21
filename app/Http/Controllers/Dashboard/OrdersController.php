<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Inertia\Inertia;

class OrdersController extends Controller
{
    public function index()
    {

        return Inertia::render('dashboard/Orders', [
            'ordersList' => Order::latest()->get()
        ]);
    }
}
