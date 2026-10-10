<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderHistoryController extends Controller {
    public function index() {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $orders = Order::where('id_user', session('user_id'))
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id) {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $order = Order::where('id_order', $id)
            ->where('id_user', session('user_id'))
            ->with('details.product')
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}