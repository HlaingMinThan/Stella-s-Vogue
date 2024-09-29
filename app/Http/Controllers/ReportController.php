<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Static\PaymentOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Get the month and payment filters from the request
        $month =  request('month'); // request('month');  // Expected format: 'YYYY-MM'
        $payment = request('payment'); //request('payment');  // Payment method filter (e.g., 'kpay', 'wave')
        $delivery = request('delivery_id'); //royal

        $reports = Order::select(
            DB::raw('DATE(orders.created_at) as date'),  // Specify the table for created_at
            DB::raw('SUM(orders.amount) as total_order_amount'),  // Specify the table for amount
            DB::raw('COUNT(orders.id) as total_ways')  // Count the total number of orders (not distinct deliveries)
        )
            ->join('deliveries', 'orders.delivery_id', '=', 'deliveries.id')  // Join deliveries table
            // Apply the month filter if present
            ->when($month, function ($query, $month) {
                return $query->whereRaw("DATE_FORMAT(orders.created_at, '%Y-%m') = ?", [$month]);
            })
            // Apply the payment filter if present and not 'all'
            ->when($payment && $payment !== 'all', function ($query) use ($payment) {
                return $query->where('orders.payment', $payment === "all" ? null : $payment);
            })
            // Apply the delivery method filter if present
            ->when($delivery && $delivery !== "all", function ($query) use ($delivery) {
                return $query->where('orders.delivery_id', $delivery === "all" ? null : $delivery);
            })
            ->groupBy(DB::raw('DATE(orders.created_at)'))  // Group by date from orders table
            ->orderBy(DB::raw('DATE(orders.created_at)'), 'DESC')  // Order by date in descending order
            ->paginate(10);


        return inertia('Admin/Reports/Index', [
            'reports' => $reports,
            'deliveries' => Delivery::all(),
            'payments' => PaymentOption::all(),
            'filters' => [
                'month' => $month,
                'payment' => $payment
            ],
            'selected' => [
                'month' => $month,
                'payment' => $payment,
                'delivery_id' => $delivery === "all" ? "all" : +$delivery
            ]
        ]);
    }
}
