<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Static\PaymentOption;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $month =  request('month'); // Expected format: 'YYYY-MM'
        $payment = request('payment'); // Payment method filter (e.g., 'kpay', 'wave')
        $delivery = request('delivery_id'); // Royal

        $reports = Order::select(
            DB::raw("DATE_FORMAT(orders.created_at, '%d-%m-%y') as date"),  // Format date to DD-MM-YY
            DB::raw('SUM(order_details.amount) as total_order_amount'),  // Sum the amount from order_details
            DB::raw('COUNT(DISTINCT orders.id) as total_ways')  // Count the total number of orders
        )
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')  // Join order_details table
            // Apply the month filter if present
            ->when($month, function ($query, $month) {
                return $query->whereRaw("DATE_FORMAT(orders.created_at, '%Y-%m') = ?", [$month]);
            })
            // Apply the payment filter if present and not 'all'
            ->when($payment && $payment !== 'all', function ($query) use ($payment) {
                return $query->where('orders.payment', $payment === "all" ? null : $payment);
            })
            // Apply the delivery method filter if present
            ->groupBy(DB::raw("DATE_FORMAT(orders.created_at, '%d-%m-%y')"))  // Group by formatted date
            ->orderBy(DB::raw("DATE_FORMAT(orders.created_at, '%d-%m-%y')"), 'DESC')  // Order by formatted date
            ->paginate(10);


        return inertia('Admin/Dashboard', [
            'reports' => $reports,
            'deliveries' => Delivery::all(),
            'payments' => PaymentOption::all(),
            'filters' => [
                'month' => $month,
                'payment' => $payment
            ],
            "stats" => [
                "total_today_order_income" => Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->whereDate('orders.created_at', Carbon::today())
                    ->sum('order_details.amount') . " MMK",
                "total_today_ways" => Order::whereDate('created_at', Carbon::today())->count(),
            ],
            'selected' => [
                'month' => $month,
                'payment' => $payment,
                'delivery_id' => $delivery === "all" ? "all" : +$delivery
            ]
        ]);
    }
}
