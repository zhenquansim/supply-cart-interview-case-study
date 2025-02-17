<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;
use Auth;

class OrderController extends Controller
{
    public function index() {
        $orders = Auth::user()->orders()->with('order_details.product')->latest()->get();
        return Inertia::render('Order/Index', compact('orders'));
    }
}
